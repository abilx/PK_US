<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <img src="logo.png" alt="Logo">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Services</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contact</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <section class="hero">
        <div class="container">
            <h1>Welcome to Our Landing Page</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed pulvinar quam et risus luctus, eget
                tempor nunc dictum.</p>
            <a href="#" class="btn btn-primary">Get Started</a>
        </div>
    </section>

    <section class="features">
        <div class="container">
            <h2>Our Features</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="feature">
                        <img src="feature1.png" alt="Feature 1">
                        <h3>Feature 1</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed pulvinar quam et risus luctus,
                            eget tempor nunc dictum.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature">
                        <img src="feature2.png" alt="Feature 2">
                        <h3>Feature 2</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed pulvinar quam et risus luctus,
                            eget tempor nunc dictum.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature">
                        <img src="feature3.png" alt="Feature 3">
                        <h3>Feature 3</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed pulvinar quam et risus luctus,
                            eget tempor nunc dictum.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="container">
            <p>&copy; 2023 Your Company. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
