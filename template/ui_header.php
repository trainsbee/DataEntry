<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paragon Financial Corp</title>
    <link rel="stylesheet" href="<?php echo API_PUBLIC ?>css/app.css">
    <script src="https://unpkg.com/feather-icons"></script>
</head>
<style>
    :root{
        --bg-primary:#101828;
        --bg-secondary:#172130;

        --border-primary:#ffffff1a;
        --border-secondary:#615fff;

        --text-primary:#99a1af;
        --text-accent:#ffffff;

        --transition: all 0.3s ease;

        --radius: 0.4rem;
    }
    .clr-primary{
        color: var(--text-primary);
    }
    body{
        background-color: var(--bg-primary);
    }
    .container{
        max-width: 1200px;
        margin: 0 auto;
    }
    .header-nav{
        background-color: var(--bg-secondary);
        border-bottom: 1px solid var(--border-primary);
        position:sticky;
        top:0;
        z-index: 10;
    }
    .brand-icon{
        width: 40px;
        height: 40px;
    }
    .header-container{
        height: 6.4rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .nav-container{
        border-top: 1px solid var(--border-primary);
        height: 5.2rem;
        max-width: 1200px;
        margin: 0 auto;
    }
    .nav-list{
        display: flex;
        align-items: center;
        height: 100%;
        gap: 3rem;
    }
    .nav-item{
        height: 100%;
        display: flex;
        align-items: center;
    }
    .nav-item a{
        text-decoration: none;
        color: var(--text-primary);
        font-size: 1.4rem;
        transition: var(--transition);
        height: 100%;
        display: flex;
        align-items: center;
        border-bottom: 2px solid transparent;
    }
    .nav-item a:hover{
        color: var(--text-accent);
        border-bottom: 2px solid var(--border-secondary);
    }   
    .nav-item a.active{
        color: var(--text-accent);
        border-bottom: 2px solid var(--border-secondary);
    }
    /* Main Content */
    .main-content{
        padding: 4rem 0;
    }

    .grid{
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 1.5rem;
    }

    .card{
        background-color: var(--bg-secondary);
        border: 1px solid var(--border-primary);
        border-radius: 0.4rem;
        padding: 1.5rem;
        transition: var(--transition);
        cursor: pointer;
        stroke: oklab(100% 0 5.96046e-8 / .1);
        
    }
    .card-temp{
        border: 1px solid var(--border-primary);
        border-radius: var(--radius);
    }
    .card-temp svg{
        width: 100%;
        height: 100%;
    }
    
    .card-header{
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
    }
    .card-body{
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }
    /* En pantallas pequeñas (móviles/tablets) */
    @media (max-width: 768px) {
    .grid {
        grid-template-columns: 1fr; /* una sola columna */
    }
    }

</style>
<body>
    <div class="header-nav">
        <header>
            <div class="header-container container">
                <div class="header-left">
                <div class="brand-icon">
                    <img src="<?php echo API_PUBLIC ?>media/mark.svg" alt="Logo">
                </div>
                </div>
                <div class="header-center">
                    <p>Admin</p>
                </div>
                <div class="header-right">
                    <p>Admin</p>
                </div>
            </div>
            <nav aria-label="Main Navigation" class="nav-container">
                <ul class="nav-list">
                    <li class="nav-item"><a href="/dashboard">Dashboard</a></li>
                    <li class="nav-item"><a href="/onboarding">Onboarding</a></li>
                    <li class="nav-item"><a href="/report">Reportes</a></li>
                    <li class="nav-item"><a href="/logout">Cerrar Sesión</a></li>
                </ul>
            </nav>

        </header>
    </div>
</body>
</html>