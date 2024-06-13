# import cs50
from cs50 import get_int
# check input
while True:
    a = get_int("Height: ")
    if a >= 1 and a <= 8:
        break
    else:
        continue
# print #
for i in range(a):
    print(" "*(a - (i + 1)) + "#" * (i + 1) + "  " + "#" * (i + 1))
# Smahdimirbagheri
