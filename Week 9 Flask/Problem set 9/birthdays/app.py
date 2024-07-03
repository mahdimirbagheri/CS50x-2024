import os

from cs50 import SQL
from flask import Flask, flash, jsonify, redirect, render_template, request, session

# Configure application
app = Flask(__name__)

# Ensure templates are auto-reloaded
app.config["TEMPLATES_AUTO_RELOAD"] = True

# Configure CS50 Library to use SQLite database
db = SQL("sqlite:///birthdays.db")


@app.after_request
def after_request(response):
    """Ensure responses aren't cached"""
    response.headers["Cache-Control"] = "no-cache, no-store, must-revalidate"
    response.headers["Expires"] = 0
    response.headers["Pragma"] = "no-cache"
    return response


@app.route("/", methods=["GET", "POST"])
def index():
    if request.method == "POST":

        # TODO: Add the user's entry into the database
        message = ""
        inputname = request.form.get("name")
        inputmonth = request.form.get("month")
        inputday = request.form.get("day")
        if not inputname:
            message = "You didn't enter any name !!"
        elif not inputmonth:
            message = "You didn't enter any mouth !!"
        elif not inputday:
            message = "You didn't enter any day !!"
        else:
            db.execute("INSERT INTO birthdays (name, month, day) VALUES(?, ?, ?)",
                       inputname,
                       inputmonth,
                       inputday,
                       )
        birthdays = db.execute("SELECT * FROM birthdays")
        return render_template("index.html", message=message, birthdays=birthdays)

    else:

        # TODO: Display the entries in the database on index.html
        birthdays = db.execute("SELECT * FROM birthdays")
        return render_template("index.html", birthdays=birthdays)
