<?php
include_once('./controllers/UtilisateurController.php');
include_once('./controllers/ChambreController.php');
include_once('./controllers/AdminController.php');
include_once('./controllers/ContactController.php');

$page = $_GET['page'] ?? 'accueil';

switch ($page) {
    // public accueil
    case 'accueil':
        include('./vues/utilisateur/listeChambres.php');
        break;
    // Utilisateur
    case 'login':
        include('./vues/utilisateur/login.php');
        break;

    case 'register':
        include('./vues/utilisateur/resgister.php');
        break;

    case 'profile':
        if (!isset($_SESSION[''])) {
            header('Location: index.php?page=login');
            exit;
        }
        $controller = new UtilisateurController();
        $user = $_SESSION['id_utilisateur'];
        include('./vues/utilisateur/profile.php');
        break;

    case 'logout':
        AuthController::logout();
        break;

    // Chambre
    case 'listeChambres':
        $controller = new ChambreController();
        $chambres = $controller->list();
        include('./vues/chambre/listeChambres.php');
        break;

    case 'detailsChambre':
        $controller = new ChambreController();
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: index.php?page=listeChambres');
            exit;
        }
        $chambre = $controller->details($id);
        include('./vues/chambre/detailsChambre.php');
        break;

    // Admin - Gestion des utilisateurs
    case 'adminDashboard':
        if (!isset($_SESSION['id_utilisateur']) || $_SESSION['id_utilisateur']['role_id'] !== 'admin') {
            header('Location: index.php?page=login');
            exit;
        }
        $adminController = new AdminController();
        $users = $adminController->getAllUsers();
        $chambres = $adminController->getAllRooms();
        include('./vues/admin/admin_dashboard.php');
        break;

    case 'addUser':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $adminController = new AdminController();
            $adminController->addUser($_POST);
            header('Location: index.php?page=adminDashboard');
        } else {
            include('./vues/admin/addUser.php');
        }
        break;

    case 'editUser':
        $adminController = new AdminController();
        $id = $_GET['id'] ?? null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $adminController->editUser($id, $_POST);
            header('Location: index.php?page=adminDashboard');
        } else {
            $user = $adminController->getUserById($id);
            include('./vues/admin/editUser.php');
        }
        break;

    case 'deleteUser':
        $adminController = new AdminController();
        $id = $_GET['id'] ?? null;
        $adminController->deleteUser($id);
        header('Location: index.php?page=adminDashboard');
        break;

    // Admin - Gestion des chambres
    case 'addRoom':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $adminController = new AdminController();
            $adminController->addRoom($_POST);
            header('Location: index.php?page=adminDashboard');
        } else {
            include('./vues/admin/addRoom.php');
        }
        break;

    case 'editRoom':
        $adminController = new AdminController();
        $id = $_GET['id'] ?? null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $adminController->editRoom($id, $_POST);
            header('Location: index.php?page=adminDashboard');
        } else {
            $room = $adminController->getRoomById($id);
            include('./vues/admin/editRoom.php');
        }
        break;

    case 'deleteRoom':
        $adminController = new AdminController();
        $id = $_GET['id'] ?? null;
        $adminController->deleteRoom($id);
        header('Location: index.php?page=adminDashboard');
        break;

    // Contact
    case 'contact':
        include('./vues/contact/form.php');
        break;
    
    case 'contactAction':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $contactController = new ContactController();
            if ($contactController->handleForm($_POST)) {
                header('Location: index.php?page=contact&success=1');
            } else {
                header('Location: index.php?page=contact&error=1');
            }
        }
        break;
    
    case 'listMessages':
        if (!isset($_SESSION['id_utilisateur']) || $_SESSION['id_utilisateur']['role_id'] !== 'admin') {
            header('Location: index.php?page=login');
            exit;
        }
        $contactController = new ContactController();
        $messages = $contactController->listMessages();
        include('./vues/contact/list.php');
        break;
    

    default:
        include('./vues/communs/header.php');
        echo '<div class="container"><h1>Bienvenue sur notre site hôtelier !</h1></div>';
        include('./vues/communs/footer.php');
        break;
}
