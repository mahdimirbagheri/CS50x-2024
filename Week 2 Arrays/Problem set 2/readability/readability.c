#include <cs50.h>
#include <ctype.h>
#include <math.h>
#include <stdio.h>
#include <string.h>

int main(void)
{
    // TODO : Get a sentences from user
    string text = get_string("Text: ");
    float l = 0;
    float w = 1;
    float s = 0;
    int n = strlen(text);
    for (int i = 0; i < n; i++)
    {
        // TODO : Count letter
        if ((text[i] >= 65 && text[i] <= 90) || (text[i] >= 97 && text[i] <= 122))
        {
            l++;
        }
        // TODO : Count word
        if (text[i] == 32)
        {
            w++;
        }
        // TODO : Count sentences
        if (text[i] == 46 || text[i] == 63 || text[i] == 33)
        {
            s++;
        }
    }
    // TODO : Calculate the degree of difficulty
    float L = 100 * (l / w);
    float S = 100 * (s / w);
    int index = round(0.0588 * L - 0.296 * S - 15.8);
    if (index >= 16)
    {
        printf("Grade 16+\n");
    }
    else if (index < 1)
    {
        printf("Before Grade 1\n");
    }
    else
    {
        printf("Grade %i\n", index);
    }
}
// Smahdimirbagheri