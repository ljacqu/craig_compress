import com.google.common.base.Strings;

import java.util.ArrayList;
import java.util.Arrays;
import java.util.Collection;
import java.util.List;

/**
 *
 */
public class BitShift {


    // a << 2 | b >> 2,
    // b & 3 << 4 | c

    public static void main(String... args) {
        final List<Integer> nums = Arrays.asList(5, 3, 12, 0, 7, 6, 10, 4, 1);
        final int fromBits = 4;
        final int toBits = 6;


        Collection<Integer> compressed = shiftString(fromBits, toBits, nums);
        System.out.println(compressed);
        Collection<Integer> undoneResult = shiftString(toBits, fromBits, shiftString(fromBits, toBits, nums));
        System.out.println(undoneResult);
        System.out.println((undoneResult.equals(nums) ? "Matches :)" : "Error: does not match"));
    }


    public static Collection<Integer> shiftString(int bitsToConsider, int bitsToUse, Collection<Integer> bytes) {
        // e.g. bitsToConsider = 4: 2^4 - 1 = 15 -> max possible number to display with bitsToConsider bits
        final int maxNumber = (int) Math.pow(2, bitsToConsider) - 1;

        StringBuilder binaryRepresentation = new StringBuilder(bitsToConsider * bytes.size());
        for (int val : bytes) {
            binaryRepresentation.append(toBinary(val & maxNumber, bitsToConsider));
        }

        // max value in result is padding value, e.g. 11111 for bitsToConsider = 5
        final String padding = toBinary((int) Math.pow(2, bitsToConsider) - 1, bitsToConsider);
        while (binaryRepresentation.length() % bitsToUse != 0) {
            binaryRepresentation.append(padding);
        }

        List<Integer> result = new ArrayList<>();
        for (int i = 0; i < binaryRepresentation.length(); i += bitsToUse) {
            result.add(Integer.parseInt(binaryRepresentation.substring(i, i + bitsToUse), 2));
        }
        return result;
    }

    // Not done
    public static int[] shift(int bitsToConsider, int bitsToUse, int[] bytes) {
        List<Integer> result = new ArrayList<>();

        int freeInCompressed = bitsToUse;
        int usedInVal = 0;
        int curCompress = 0;
        for (int val : bytes) {
            // 22 in 1100 -> 1122





            if (freeInCompressed == bitsToConsider) {
                curCompress |= val;
                freeInCompressed = 0;
                usedInVal = bitsToConsider;
            } else if (freeInCompressed > bitsToConsider) {
                curCompress |= val << (freeInCompressed - bitsToConsider);
                freeInCompressed -= bitsToConsider;
                usedInVal = bitsToConsider;
            } else { // freeBits < bitsToConsider
                int freeBits = bitsToConsider - freeInCompressed;
                curCompress |= val >> freeBits;
                freeInCompressed = 0;
                usedInVal += (bitsToConsider - freeInCompressed);
            }
            // // e.g. 12 -> 15 - 3, (16-1) - (4-1) = (2^4 - 1) - (2^2-1)
            // int andVal = (int) ((Math.pow(2, bitsToConsider) - 1) - (Math.pow(2, compressedIndex) - 1));
            int shiftNumber = freeInCompressed << 2;

        }
        return null;
    }

    private static String toBinary(int number, int representationLength) {
        return padZeroes(Integer.toString(number, 2), representationLength);
    }

    private static String padZeroes(String text, int length) {
        return Strings.repeat("0", length - text.length()) + text;
    }


}
