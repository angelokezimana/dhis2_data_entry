# Dhis 2 Tutorial

Educational DHIS2 API Interaction: HIV Care Monthly Dataset

## Description

This project is an educational website focused on interacting with the DHIS2 platform, specifically targeting the HIV Care Monthly dataset. The goal is to provide a learning resource for individuals interested in working with DHIS2 APIs and gaining hands-on experience with the HIV Care Monthly data.

## Table of Contents

- [Introduction](#introduction)
- [Features](#features)
- [Getting Started](#getting-started)
  - [Prerequisites](#prerequisites)
  - [Installation](#installation)
- [Contributing](#contributing)
- [License](#license)
- [Contact](#contact)

## Introduction

Welcome to the Educational DHIS2 API Interaction: HIV Care Monthly Dataset project! This initiative is designed to serve as a comprehensive learning resource, guiding individuals through the process of interacting with the DHIS2 platform, with a specific emphasis on the intricacies of the HIV Care Monthly dataset.

## Features

- **Interactive Exploration**: Engage with a dynamic and user-friendly interface that facilitates the exploration of DHIS2 APIs in real-time.
- **Targeted Dataset**: Concentrate your learning efforts on the intricacies of the `HIV Care Monthly` dataset, gaining practical insights into the nuances of health data management.

## Getting Started

Instructions for setting up the project locally.

### Prerequisites

Make sure you have the following tools and dependencies installed:

- Node.js
- Composer
- PHP

### Installation

Clone the repository:

```bash
git clone https://github.com/angelokezimana/dhis2_data_entry.git
cd dhis2_data_entry
```

Install PHP dependencies:

```bash
composer install
```

Install Node.js dependencies using Yarn:

```bash
yarn install
```

Copy the environment file and set up your environment variables:

```bash
cp .env.example .env
```

Update the .env file with your configuration.

Generate application key:

```bash
php artisan key:generate
```

Migrate and seed the database:

```bash
php artisan migrate --seed
```

Start the development server:

```bash
php artisan serve
yarn run dev
```

## Contributing

If you'd like to contribute to this project, please open an issue or submit a pull request.

## License

This project is licensed under the [MIT License](LICENSE).

## Contact

Feel free to reach out to me at kezangelo at gmail (dot) com for any questions or feedback.
