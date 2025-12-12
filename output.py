import random

def get_random_numbers(n=3):
    numbers = list(range(1, 101))
    return random.sample(numbers, n)

def sum_numbers(numbers):
    return sum(numbers)

numbers = get_random_numbers(5)
for number in numbers:
    print(f"hello {number}")
print(sum_numbers(numbers))
