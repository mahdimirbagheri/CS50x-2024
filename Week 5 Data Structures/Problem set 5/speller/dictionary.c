// Implements a dictionary's functionality

#include "dictionary.h"

#include <ctype.h>
#include <stdbool.h>
#include <stdint.h>
#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <strings.h>

// Represents a node in a hash table
typedef struct node
{
    char word[LENGTH + 1];
    struct node *next;
} node;

// TODO: Choose number of buckets in hash table
const unsigned int N = 100000;

// Hash table
node *table[N];

int dict_size = 0;

// Returns true if word is in dictionary, else false
bool check(const char *word)
{
    // TODO : Checking the existence of the word in the dictionary
    int hash_value = hash(word);
    node *n = table[hash_value];
    // check strings
    while (n != NULL)
    {
        if (strcasecmp(word, n->word) == 0)
        {
            return true;
        }
        n = n->next;
    }
    return false;
}

// Hashes word to a number
unsigned int hash(const char *word)
{
    // TODO: Improve this hash function
    /*
    This hash function looks at the letters of the word,
    and the ascii code receives their lowercase letters,
    and the remainder of the sum of ascii codes is obtained by the buckets
    */
    long sigma = 0;
    for (int i = 0; i < strlen(word); i++)
    {
        sigma += tolower(word[i]);
    }
    return sigma % N;
}

// Loads dictionary into memory, returning true if successful, else false
bool load(const char *dictionary)
{
    // TODO : Open File and Read File
    FILE *dict_pointer = fopen(dictionary, "r");
    if (dictionary == NULL)
    {
        printf("Could not open %s\n", dictionary);
        return false;
    }
    // TODO : Transfer file to memory and read word in dict
    char next_word[LENGTH + 1];
    while (fscanf(dict_pointer, "%s", next_word) != EOF)
    {
        node *n = malloc(sizeof(node));
        if (n == NULL)
        {
            return false;
        }
        strcpy(n->word, next_word);
        int hash_value = hash(next_word);

        n->next = table[hash_value];
        table[hash_value] = n;
        dict_size++;
    }
    fclose(dict_pointer);
    return true;
}

// Returns number of words in dictionary if loaded, else 0 if not yet loaded
unsigned int size(void)
{
    // TODO : return dict_size
    return dict_size;
}

// Unloads dictionary from memory, returning true if successful, else false
bool unload(void)
{
    // TODO : free buckets
    for (int i = 0; i < N; i++)
    {
        node *n = table[i];
        while (n != NULL)
        {
            node *temp = n;
            n = n->next;
            free(temp);
        }
        if (n == NULL && i == N - 1)
        {
            return true;
        }
    }
    return false;
}
// Smahdimirbagheri
