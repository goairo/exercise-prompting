# AI Prompting Techniques for PHP7 to PHP8 Refactoring

This guide provides concise prompting strategies to leverage AI for refactoring PHP code that uses the deprecated `each()` function to modern PHP8 standards.

## Zero-Shot Prompting

Direct instructions without examples:

```
Refactor this PHP7 code to PHP8 by replacing the deprecated each() function with foreach loops:
[CODE]
```

## Few-Shot Prompting

Providing 1-2 examples before asking for your task:

```
Example:
Original: 
while (list($key, $value) = each($array)) {
    echo "$key: $value\n";
}

Refactored:
[CODE]
```

## Many-Shot Prompting

Multiple examples of increasing complexity.


## Chain of Thought Prompting

Prompting the AI to think step-by-step:

```
I need to refactor this PHP7 code that uses the deprecated each() function to PHP8. 
Please think through this step-by-step:
[STEPS]

Here's my code:
[CODE]
```

## ACDQ

Prompt with assigning a role, provide additional context (see each-function-reference.md).

```
[PROMPT]
```

## Best Practices Summary

- Provide clear context about what the code does
- Experiment with different models and prompt techniques for complex refactoring tasks