# Import library
import string
from cs50 import get_string
# Give input
txt = get_string("Text: ")
# Count letters
letters = 0
for i in txt:
    if (i.isalpha()):
        letters += 1
# Count words
words = len(txt.split())
# Count sentences
sentences = 0
for j in txt:
    if (j == "." or j == "?" or j == "!"):
        sentences += 1
wordsentences = words / 100
l = letters / wordsentences
s = sentences / wordsentences
index = round(0.0588 * l - 0.296 * s - 15.8)
if index < 1:
    print("Before Grade 1")
elif index >= 16:
    print("Grade 16+")
else:
    print(f"Grade {index}")
# Smahdimirbagheri
