# AI Prompting Techniques for Code Documentation

This guide provides effective prompting strategies to leverage AI for documenting undocumented or poorly documented code.

## Exercise Overview

In this exercise, you'll practice different prompting techniques to generate meaningful documentation for the `DocumentProcessor` class and its methods. The code lacks proper documentation, making it difficult for new developers to understand its functionality, parameters, return values, and overall purpose.

Generate a DOCUMENTATION.MD


## Role-Based Prompting

Assigning a specific role to the AI can yield different documentation styles and focuses:

### Senior Engineer Role

```
You are a senior PHP developer with 10+ years of experience writing maintainable enterprise code. Document this code with PHPDoc comments that focus on architectural patterns, potential edge cases, and long-term maintainability considerations:
[CODE]
```

### Support Engineer Role

```
You are a technical support engineer who helps other developers understand and use this code. Write documentation that explains how each component works, with a focus on usage examples and common pitfalls to avoid:
[CODE]
```