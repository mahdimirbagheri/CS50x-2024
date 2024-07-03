import os

from cs50 import SQL
from flask import Flask, flash, redirect, render_template, request, session
from flask_session import Session
from tempfile import mkdtemp
from werkzeug.security import check_password_hash, generate_password_hash

from helpers import apology, login_required, lookup, usd

# Configure application
app = Flask(__name__)

# Custom filter
app.jinja_env.filters["usd"] = usd

# Configure session to use filesystem (instead of signed cookies)
app.config["SESSION_PERMANENT"] = False
app.config["SESSION_TYPE"] = "filesystem"
Session(app)

# Configure CS50 Library to use SQLite database
db = SQL("sqlite:///finance.db")


@app.after_request
def after_request(response):
    """Ensure responses aren't cached"""
    response.headers["Cache-Control"] = "no-cache, no-store, must-revalidate"
    response.headers["Expires"] = 0
    response.headers["Pragma"] = "no-cache"
    return response


@app.route("/")
@login_required
def index():
    """Show portfolio of stocks"""
    user_id = session["user_id"]

    # Get the user info
    items = db.execute(
        "SELECT symbol, name, price, SUM(shares) AS shares FROM transactions WHERE user_id = ? GROUP BY symbol", user_id)

    # Cash that the user has
    cash_db = db.execute("SELECT cash FROM users WHERE id = ?", user_id)
    cash = cash_db[0]["cash"]

    total = cash

    for item in items:
        total += item["price"] * item["shares"]

    return render_template("index.html", items=items, cash=cash, usd=usd, total=total)


@app.route("/buy", methods=["GET", "POST"])
@login_required
def buy():
    """Buy shares of stock"""
    # User reached out via POST
    if request.method == "POST":
        symbol = request.form.get("symbol").upper()
        item = lookup(symbol)

        # Ensure symbol is submitted
        if not symbol:
            return apology("Enter a symbol")
        elif not item:
            return apology("Invalid symbol")

        # Ensure shares are integers
        try:
            shares = int(request.form.get("shares"))
        except:
            return apology("Shares must be an integer")

        # Ensure integer is positive
        if shares <= 0:
            return apology("Shares must be positive integers")

        # Obtain users information
        user_id = session["user_id"]
        cash = db.execute("SELECT cash FROM users WHERE id = ?", user_id)[0]["cash"]

        item_name = item["name"]
        item_price = item["price"]
        total_price = item_price * shares

        # Ensure user has enough cash to buy a share
        if cash < total_price:
            return apology("Not enough cash")

        # Update the users infomation if there is enough cash to buy
        else:
            db.execute("UPDATE users SET cash = ? WHERE id = ?", cash - total_price, user_id)
            db.execute("INSERT INTO transactions (user_id, name, shares, price, type, symbol) VALUES (?, ?, ?, ?, ?, ?)",
                       user_id, item_name, shares, item_price, "buy", symbol)

        flash("BOUGHT!")

        # Redirect user to home page
        return redirect("/")

    # User reached out via GET
    else:
        return render_template("buy.html")


@app.route("/history")
@login_required
def history():
    """Show history of transactions"""
    return apology("TODO")


@app.route("/login", methods=["GET", "POST"])
def login():
    """Log user in"""

    # Forget any user_id
    session.clear()

    # User reached route via POST (as by submitting a form via POST)
    if request.method == "POST":
        # Ensure username was submitted
        if not request.form.get("username"):
            return apology("must provide username", 403)

        # Ensure password was submitted
        elif not request.form.get("password"):
            return apology("must provide password", 403)

        # Query database for username
        rows = db.execute(
            "SELECT * FROM users WHERE username = ?", request.form.get("username")
        )

        # Ensure username exists and password is correct
        if len(rows) != 1 or not check_password_hash(
            rows[0]["hash"], request.form.get("password")
        ):
            return apology("invalid username and/or password", 403)

        # Remember which user has logged in
        session["user_id"] = rows[0]["id"]

        # Redirect user to home page
        return redirect("/")

    # User reached route via GET (as by clicking a link or via redirect)
    else:
        return render_template("login.html")


@app.route("/logout")
def logout():
    """Log user out"""

    # Forget any user_id
    session.clear()

    # Redirect user to login form
    return redirect("/")


@app.route("/quote", methods=["GET", "POST"])
@login_required
def quote():
    """Get stock quote."""
    # User reached out via POST
    if request.method == "POST":
        symbol = request.form.get("symbol")

        # Ensure quote is submitted
        if not symbol:
            return apology("Please enter a symbol")

        item = lookup(symbol)

        # Ensure the item is valid
        if not item:
            return apology("Please enter a valid symbol")

        return render_template("quoted.html", item=item, usd=usd)

    # User reached out via GET
    else:
        return render_template("quote.html")


@app.route("/register", methods=["GET", "POST"])
def register():
    """Register user"""
    # User reached out via GET
    if request.method == "GET":
        return render_template("register.html")

    # User reached out via POST
    else:
        username = request.form.get("username")
        password = request.form.get("password")
        confirmation = request.form.get("confirmation")

        # Ensure that the username, password and confirmation password are submitted
        if not username:
            return apology("Must provide a username")

        if not password:
            return apology("Must provide a password")

        if not confirmation:
            return apology("Must provide confirmation password")

        # Ensure password and confirmation password are the same
        if password != confirmation:
            return apology("Password and confirmation password do not match")

        # Make the users password secure with hash
        hash = generate_password_hash(password)

        try:
            # INSERT INTO table_name (column1, column2,) VALUES (value1, value2)
            new_user = db.execute(
                "INSERT INTO users (username, hash) VALUES (?, ?)", username, hash)
        except:
            return apology("Username already exists")

        # Redirect the user to the index page
        session["user_id"] = new_user

        # Redirect user to homepage
        return redirect("/")


@app.route("/sell", methods=["GET", "POST"])
@login_required
def sell():
    """Sell shares of stock"""
    # User reached out via POST
    if request.method == "POST":
        user_id = session["user_id"]
        symbol = request.form.get("symbol")
        shares = int(request.form.get("shares"))

        # Ensure shares are positive numbers
        if shares <= 0:
            return apology("Shares must be a positive number")

        # Check price and name of stock
        item_price = lookup(symbol)["price"]
        item_name = lookup(symbol)["name"]
        price = shares * item_price

        # Ensure user has the correct amount of shares that can be sold
        shares_owned = db.execute(
            "SELECT shares FROM transactions WHERE user_id = ? AND symbol = ? GROUP BY symbol", user_id, symbol)[0]["shares"]

        if shares_owned < shares:
            return apology("You don't have that many shares")

        # Update the database if the transaction is successful
        current_cash = db.execute("SELECT cash FROM users WHERE id = ?", user_id)[0]["cash"]

        db.execute("UPDATE users SET cash = ? WHERE id = ?", current_cash + price, user_id)
        db.execute("INSERT INTO transactions (user_id, name, shares, price, type, symbol) VALUES (?, ?, ?, ?, ?, ?)",
                   user_id, item_name, -shares, item_price, "sell", symbol)

        flash("SOLD!")

        # Redirect user to home page
        return redirect("/")

    # User reached out via GET
    else:
        user_id = session["user_id"]

        symbols = db.execute(
            "SELECT symbol FROM transactions WHERE user_id = ? GROUP BY symbol", user_id)
        return render_template("sell.html", symbols=symbols)
