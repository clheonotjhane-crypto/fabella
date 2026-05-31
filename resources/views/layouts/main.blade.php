<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        .sidebar {
            min-height: 100vh;
            background-color: rgb(52, 72, 93);
        }
        .sidebar .nav-link {
            color: white;
        }
        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            background-color: rgba(255,255,255,0.1);
        }
        .navbar {
            background-color: rgb(52, 72, 93);
        }
    </style>
</head>
<body>
    @if(session('success') || session('error'))
        <!-- Toast Container -->
        <div class="toast-container position-fixed top-0 end-0 p-3">
            @if(session('success'))
                <div class="toast bg-success text-white" role="alert">
                    <div class="toast-body">
                        {{ session('success') }}
                    </div>
                </div>
            @endif
            
            @if(session('error'))
                <div class="toast bg-danger text-white" role="alert">
                    <div class="toast-body">
                        {{ session('error') }}
                    </div>
                </div>
            @endif
        </div>
    @endif

    @yield('content')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <!-- Toast JS -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const toastElList = document.querySelectorAll('.toast');
            toastElList.forEach(function(toastEl) {
                const toast = new bootstrap.Toast(toastEl, {
                    delay: 3000 // 3 seconds
                });
                toast.show();
            });
        });
    </script>
    
    @stack('scripts')
</body>
</html>