#include <cs50.h>
#include <stdio.h>

int main(void)
{
    int height, j, i, f, e;

    // get number from user
    do
    {
        height = get_int("Enter A Number : ");
    } while (height < 1 || height > 8);

    // make a main for
    for (i = 1; i <= height; i++)
    {

        // print space
        for (f = 0; f < height - i; f++)
        {
            printf(" ");
        }

        // print # Ascending
        for (j = 1; j <= i; j++)
        {
            printf("#");
        }

        // print # Descending
        printf("  ");
        for (e = 1; e <= i; e++)
        {
            printf("#");
        }
        printf("\n");
    }
}
// Smahdimirbagheri