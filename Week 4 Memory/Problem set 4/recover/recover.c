#include <stdint.h>
#include <stdio.h>
#include <stdlib.h>

int main(int argc, char *argv[])
{
    if (argc < 2)
    {
        printf("Usage: ./recover FILE\n");
        return 1;
    }
    // Open the memory card
    FILE *memory = fopen(argv[1], "r");
    // Make temp with a size of 512 bytes
    unsigned char *temp = malloc(512);

    char *filename = malloc(3 * sizeof(int));

    int image = 0;

    if (temp == NULL)
    {
        return 1;
    }

    if (filename == NULL)
    {
        return 1;
    }
    // Check the conditions of the JPG file
    while (fread(temp, sizeof(unsigned char), 512, memory))
    {
        if (temp[0] == 0xff && temp[1] == 0xd8 && temp[2] == 0xff && (temp[3] & 0xf0) == 0xe0)
        {
            sprintf(filename, "%03i.jpg", image);
            FILE *imgf = fopen(filename, "w");
            fwrite(temp, 1, 512, imgf);
            fclose(imgf);

            image++;
        }

        else if (image != 0)
        {
            FILE *imgf = fopen(filename, "a");
            fwrite(temp, 1, 512, imgf);
            fclose(imgf);
        }
    }
    // Free Memory
    free(temp);
    free(filename);
    fclose(memory);
}
// Smahdimirbagheri
