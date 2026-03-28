# LetsWatch

![Laravel](https://img.shields.io/badge/Laravel-12-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.3-777BB4?style=for-the-badge&logo=php&logoColor=white)
![PostgreSQL](https://img.shields.io/badge/PostgreSQL-316192?style=for-the-badge&logo=postgresql&logoColor=white)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)
![Docker](https://img.shields.io/badge/Docker-2496ED?style=for-the-badge&logo=docker&logoColor=white)

---

**LetsWatch** is an interactive web application designed to solve the classic "decision fatigue" when picking a movie. Using a swipe-based mechanic inspired by dating apps, users can like or dislike popular titles, create groups, and easily find a "match" of what to watch with friends.

---

## Main Features

* **Interactive Swipe Mechanic:** Fluid JS interface with touch/mouse support and smooth animations.
* **TMDB API Integration:** Dynamic and optimized consumption of The Movie Database catalog.
* **Group System:** Create rooms for friends to find common movie matches.
* **Secure Auth:** Email verification and signed routes for user security.
* **App-like UI:** Fully responsive design built with Tailwind CSS.

---

## Tech Stack & Infrastructure

* **Backend:** PHP 8.3 + Laravel 12
* **Database:** PostgreSQL (Cloud hosted via Neon DB)
* **Frontend:** Blade Templates, Tailwind CSS + Vite, Vanilla Javascript.
* **Local Environment:** Docker + Laravel Sail (WSL2 compatible)
* **Deployment & CI/CD:** Render (Web Services)
* **Email Service:** Brevo (Production) & Mailpit (Local)

---

## Architecture & Best Practices

* **API Decoupling:** Communication with TMDB is isolated through services and managed via environment variables.
* **Visual Componentization:** Clean UI development using Tailwind CSS within Blade components.
* **Database Optimization:** Direct connections to Neon DB ensuring migration integrity and fast query performance.

---

## Local Execution 

### Prerequisites 
* [Docker](https://docs.docker.com/get-docker/) (Desktop or Engine)
* WSL 2 (For Windows users)
* [TMDB API Key](https://www.themoviedb.org/documentation/api)

### Setup Steps 

1.  **Clone the repository**
    ```bash
    git clone https://github.com/mandynhaaa/LetsWatch.git
    cd LetsWatch
    ```

2.  **Install PHP Dependencies**
    ```bash
    composer install
    ```

3.  **Environment Setup**
    ```bash
    cp .env.example .env
    ```
    *Note: Add your `TMDB_API_KEY` to the `.env` file.*

4.  **Start Laravel Sail (Docker):**
    ```bash
    ./vendor/bin/sail up -d
    ```

5.  **Prepare Application**
    ```bash
    ./vendor/bin/sail artisan key:generate
    ./vendor/bin/sail artisan migrate
    ```

6.  **Frontend Setup**
    ```bash
    ./vendor/bin/sail npm install
    ./vendor/bin/sail npm run dev
    ```

*App will be live at `http://localhost`. Email testing via Mailpit at `http://localhost:8025`.*

---

## Acknowledgments

A special thank you to [**Mickael Saymon**](https://github.com/MickaelSaymon) for his invaluable idea, collaboration and support throughout the development of this project.

I would also like to express my gratitude to [**Rodrigo Costa**](https://github.com/rodrigocoosta) and [**UDESC**](https://www.udesc.br/) (Santa Catarina State University) for their technical guidance and academic support.

---

## Copyright

© 2026 LetsWatch. All rights reserved.

This project was conceptualized and developed by [**Amanda Tobler**](https://github.com/mandynhaaa). Copying or distributing the code for commercial purposes without prior authorization is strictly prohibited.
