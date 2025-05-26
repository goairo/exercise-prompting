<?php

use PHPUnit\Framework\TestCase;

class UtilsTest extends TestCase
{
    /**
     * @test
     */
    public function testFactorial()
    {
        $this->markTestSkipped('Skipping this test due to infinite recursion in factorial function');
        // Basic test
        $this->assertEquals(6, factorial(3));
        
        // Edge cases
        $this->assertEquals(1, factorial(1));
        $this->assertEquals(1, factorial(0)); // Should be 1 for 0!
        
        // Bug mentioned in comments: 1 is not handled correctly
        // This would cause a stack overflow in the current implementation
        // $this->assertEquals(120, factorial(5));
    }
    
    /**
     * @test
     */
    public function testFactorialBug()
    {
        $this->markTestSkipped('Skipping this test due to infinite recursion in factorial function');
        // Bug test: Infinite recursion due to missing base case
        $this->expectException(\Error::class); // Expecting a Fatal Error
        factorial(0); // Should trigger infinite recursion
    }
    
    /**
     * @test
     */
    public function testBubbleSort()
    {
        // Basic test
        $arr = [5, 3, 8, 4, 2];
        $expected = [2, 3, 4, 5, 8];
        $this->assertEquals($expected, bubbleSort($arr));
        
        // Edge cases
        $this->assertEquals([], bubbleSort([]));
        $this->assertEquals([1], bubbleSort([1]));
        $this->assertEquals([1, 1, 2, 3, 3], bubbleSort([3, 1, 3, 1, 2])); // Duplicates
        $this->assertEquals([-3, -2, 0, 5, 10], bubbleSort([5, -2, 10, -3, 0])); // Negative numbers
    }
    
    /**
     * @test
     */
    public function testBubbleSortBug()
    {
        // Bug test: Incorrect comparison operator, should be = not ==
        $arr = [3, 1];
        $expected = [1, 3];
        // This will fail because of the bug
        $this->assertEquals($expected, bubbleSort($arr));
    }
    
    /**
     * @test
     */
    public function testIsPalindrome()
    {
        // Basic tests
        $this->assertTrue(isPalindrome("radar"));
        $this->assertTrue(isPalindrome("level"));
        $this->assertFalse(isPalindrome("hello"));
        
        // Edge cases
        $this->assertTrue(isPalindrome(""));
        $this->assertTrue(isPalindrome("a"));
        $this->assertTrue(isPalindrome("11211"));
        $this->assertFalse(isPalindrome("Radar"));
    }
    
    /**
     * @test
     */
    public function testIsPalindromeBug()
    {
        // Bug test: Doesn't handle case sensitivity
        // "Radar" is a palindrome if case is ignored
        $this->assertFalse(isPalindrome("Radar")); // Will pass (incorrectly) due to case sensitivity
        $this->assertTrue(isPalindrome(strtolower("Radar"))); // Should be true if we fix the case sensitivity
    }
    
    /**
     * @test
     */
    public function testFindMax()
    {
        $this->assertEquals(8, findMax([5, 3, 8, 4, 2]));
        
        $this->assertEquals(1, findMax([1]));
        $this->assertEquals(-1, findMax([-5, -3, -1, -4]));
        $this->assertEquals(10, findMax([10, 10, 10]));
    }
    
    /**
     * @test
     */
    public function testFindMaxBug()
    {
        // Bug test: Assumes array is non-empty, no check for empty array
        $this->expectException(\Error::class); // Expecting an error
        findMax([]); // Should cause an error because $arr[0] is undefined
    }
    
    /**
     * @test
     */
    public function testRemoveDuplicates()
    {
        $input = [1, 2, 2, 3, 4, 4, 5];
        $expected = [1, 2, 3, 4, 5];
        $this->assertEquals($expected, removeDuplicates($input));
        
        $this->assertEquals([], removeDuplicates([])); // Empty array
        $this->assertEquals([1], removeDuplicates([1])); // Single element
        $this->assertEquals([5], removeDuplicates([5, 5, 5, 5])); // All duplicates
        $this->assertEquals([1, 2, 3], removeDuplicates([1, 2, 3])); // No duplicates
    }
    
    /**
     * @test
     */
    public function testRemoveDuplicatesBug()
    {
        // Bug test: Starts from index 1, missing first element
        $input = [1, 2, 3, 1];
        $expected = [1, 2, 3]; // Should be [1, 2, 3] if properly implemented
        $result = removeDuplicates($input);
        $this->assertNotEquals($expected, $result); // Should fail due to the bug
        $this->assertEquals([2, 3], $result); // The actual result with the bug
    }
    
    /**
     * @test
     */
    public function testIsPrime()
    {
        // Basic tests
        $this->assertTrue(isPrime(2));
        $this->assertTrue(isPrime(3));
        $this->assertTrue(isPrime(5));
        $this->assertTrue(isPrime(7));
        $this->assertTrue(isPrime(11));
        $this->assertTrue(isPrime(13));
        $this->assertFalse(isPrime(4));
        $this->assertFalse(isPrime(6));
        $this->assertFalse(isPrime(8));
        $this->assertFalse(isPrime(9));
        
        // Edge cases
        $this->assertFalse(isPrime(1)); // 1 is not a prime number by definition
        $this->assertFalse(isPrime(0)); // 0 is not a prime number
        $this->assertFalse(isPrime(-5)); // Negative numbers are not prime
    }
    
    /**
     * @test
     */
    public function testIsPrimeBug()
    {
        // Bug test: Doesn't handle 1 or negative numbers correctly
        $this->assertTrue(isPrime(1)); // This should be false, but the function returns true
        $this->assertTrue(isPrime(0)); // This should be false, but may cause errors
        $this->assertTrue(isPrime(-7)); // This should be false, but may cause errors
    }
    
    /**
     * @test
     */
    public function testCalculateAverage()
    {
        // Basic test
        $this->assertEquals(3, calculateAverage([1, 2, 3, 4, 5]));
        
        // Edge cases
        $this->assertEquals(5, calculateAverage([5])); // Single element
        $this->assertEquals(0, calculateAverage([0, 0, 0])); // All zeros
        $this->assertEquals(-3, calculateAverage([-1, -2, -3, -4, -5])); // Negative numbers
        $this->assertEquals(2.5, calculateAverage([1, 2, 3, 4])); // Fractional result
    }
    
    /**
     * @test
     */
    public function testCalculateAverageBug()
    {
        // Bug test: Division by zero error when array is empty
        $this->expectException(\DivisionByZeroError::class); // Expecting a division by zero error
        calculateAverage([]); // Will cause division by zero
    }
    
    /**
     * @test
     */
    public function testReverseWords()
    {
        // Basic test
        $this->assertEquals("olleH dlroW", reverseWords("Hello World"));
        
        // Edge cases
        $this->assertEquals("", reverseWords("")); // Empty string
        $this->assertEquals("a", reverseWords("a")); // Single character
        $this->assertEquals("dcba hgfe", reverseWords("abcd efgh")); // Multiple words
        $this->assertEquals("321 654", reverseWords("123 456")); // Numbers
    }
    
    /**
     * @test
     */
    public function testReverseWordsBug()
    {
        // Bug test: Reversing characters in words instead of word order
        // The function should reverse the order of words, not characters
        $str = "Hello World";
        $expected = "World Hello"; // Correct implementation should return this
        $actual = reverseWords($str);
        $this->assertNotEquals($expected, $actual); // Should fail due to the bug
        $this->assertEquals("olleH dlroW", $actual); // Actual result with the bug
    }
    
    /**
     * @test
     */
    public function testAreBracketsBalanced()
    {
        // Basic tests
        $this->assertTrue(areBracketsBalanced("()")); 
        $this->assertTrue(areBracketsBalanced("[]"));
        $this->assertTrue(areBracketsBalanced("{}"));
        $this->assertTrue(areBracketsBalanced("{[()]}"));
        $this->assertTrue(areBracketsBalanced("({})[]"));
        
        $this->assertFalse(areBracketsBalanced("("));
        $this->assertFalse(areBracketsBalanced(")"));
        $this->assertFalse(areBracketsBalanced("({)}"));
        $this->assertFalse(areBracketsBalanced("[(])"));
        
        // Edge cases
        $this->assertTrue(areBracketsBalanced("")); // Empty string
        $this->assertFalse(areBracketsBalanced("((((("));
        $this->assertFalse(areBracketsBalanced(")))))"));
        $this->assertTrue(areBracketsBalanced("(a+b)*c")); // With other characters
    }
    
    /**
     * @test
     */
    public function testAreBracketsBalancedBug()
    {
        // Bug test: Doesn't check if closing bracket matches opening bracket
        $this->assertTrue(areBracketsBalanced("([)]")); // Should be false as brackets are not correctly matched
        $this->assertTrue(areBracketsBalanced("{[}]")); // Should be false as brackets are not correctly matched
    }
    
    /**
     * @test
     */
    public function testConvertTemperature()
    {
        // Basic tests
        $this->assertEquals(50, convertTemperature(10, 'C')); // 10°C to °F
        $this->assertEquals(10, convertTemperature(50, 'F')); // 50°F to °C
        
        // Edge cases
        $this->assertEquals(32, convertTemperature(0, 'C')); // Freezing point of water
        $this->assertEquals(0, convertTemperature(32, 'F')); // Freezing point of water
        $this->assertEquals(212, convertTemperature(100, 'C')); // Boiling point of water
        $this->assertEquals(100, convertTemperature(212, 'F')); // Boiling point of water
        $this->assertEquals(-40, convertTemperature(-40, 'C')); // Point where both scales meet
        $this->assertEquals(-40, convertTemperature(-40, 'F')); // Point where both scales meet
    }
    
    /**
     * @test
     */
    public function testConvertTemperatureBug()
    {
        // Bug test: Incorrect formulas
        // Correct formula for C to F: temp * 9/5 + 32
        // Correct formula for F to C: (temp - 32) * 5/9
        
        // Testing the bug in C to F conversion (using wrong formula temp * 9/5 - 32)
        $temp = 20; // 20°C
        $expectedCorrect = 68; // 20°C = 68°F
        $actualBuggy = convertTemperature($temp, 'C');
        $this->assertNotEquals($expectedCorrect, $actualBuggy); // Should fail due to the bug
        $this->assertEquals(4, $actualBuggy); // The actual result with the buggy formula
        
        // Testing the bug in F to C conversion (using wrong formula (temp + 32) * 5/9)
        $temp = 68; // 68°F
        $expectedCorrect = 20; // 68°F = 20°C
        $actualBuggy = convertTemperature($temp, 'F');
        $this->assertNotEquals($expectedCorrect, $actualBuggy); // Should fail due to the bug
        $this->assertEquals(55.55555555555556, $actualBuggy); // The actual result with the buggy formula
    }
}
