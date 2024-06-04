#include <cs50.h>
#include <ctype.h>
#include <stdio.h>
#include <stdlib.h>
#include <string.h>

int main(int argc, string argv[])
{
    // Check Check to receive an entry
    if (argc != 2)
    {
        printf("Usage: ./caesar key\n");
        return 1;
    }
    // Check that the string is not included
    int n = strlen(argv[1]);
    for (int i = 0; i < n; i++)
    {
        if (isalpha(argv[1][i]))
        {
            printf("Usage: ./caesar key\n");
            return 1;
        }
    }
    // Input plaintext from user
    string plain = get_string("plaintext:  ");
    // Convert argv to int and give key
    int key = atoi(argv[1]);
    // Output : Show ciphertext
    char co;
    int nm = strlen(plain);
    char cipher[nm];
    for (int j = 0; j < nm; j++)
    {
        int c = plain[j];
        if (isalpha(c))
        {
            co = c + key % 26;
            if (!(islower(co) || isupper(co)))
            {
                co -= 26;
            }
        }
        else
        {
            co = c;
        }
        cipher[j] = co;
    }
    printf("ciphertext: %s\n", cipher);
    return 0;
}
// Smahdimirbagheri
