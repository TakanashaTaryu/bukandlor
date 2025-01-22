import pandas as pd
from faker import Faker
import random

# Initialize Faker
fake = Faker()

# Define possible values for 'Gems', 'Status', and 'State'
gems_options = ['Ruby', 'Sapphire', 'Emerald', 'Diamond']
status_options = ['Active', 'Inactive', 'Pending']
state_options = ['Stage 1', 'Stage 2', 'Stage 3', 'Completed']

# Generate fake data
data = []
for _ in range(50):  # Generate 50 fake records
    nim = fake.unique.random_int(min=1000000, max=9999999)
    name = fake.name()
    email = fake.email()
    major = fake.random_element(elements=['Computer Science', 'Engineering', 'Mathematics', 'Physics'])
    class_name = f"Class {random.randint(1, 10)}-{random.choice(['A', 'B', 'C'])}"
    gems = random.choice(gems_options)
    status = random.choice(status_options)
    state = random.choice(state_options)

    data.append([nim, name, email, major, class_name, gems, status, state])

# Create DataFrame
df = pd.DataFrame(data, columns=['NIM', 'Name', 'Email', 'Major', 'Class', 'Gems', 'Status', 'State'])

# Save to Excel
file_name = "test_caas.xlsx"
df.to_excel(file_name, index=False)

print(f"Test Excel file '{file_name}' has been created successfully!")

