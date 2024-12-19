<!-- index.php
<?php
include_once('./bdd/connexion.php');
include_once('./controller/UtilisateurController.php');
include_once('./controller/ChambreController.php');
include_once('./controller/AdminController.php');
include_once('./controller/ContactController.php');

if (!isset($_SESSION)) {    session_start();}

$page = $_GET['page'] ?? 'accueil';

switch ($page) {
    // Utilisateur
    case 'login':
        include('./vue/utilisateur/login.php');
        break;
    
    case 'loginAction':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $pass = $_POST['pass'] ?? '';
            $controller = new UtilisateurController();
            $controller->login($email, $pass);
        }
        break;
            
        
    case 'logout':
        include('./vue/utilisateur/logout.php');
        //AuthController::logout();
        break;

    case 'register':
        include('./vue/utilisateur/resgister.php');
        break;

    case 'profile':
        if (!isset($_SESSION['id_user'])) {
            header('Location: index.php?page=login');
            exit;
        }
        include('./vue/utilisateur/profile.php');
        break;

    

    // Chambre
    case 'listeChambres':
        $controller = new ChambreController();
        $chambres = $controller->list();
        include('./vue/chambre/listeChambres.php');
        break;

    case 'detailsChambre':
        $controller = new ChambreController();
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: index.php?page=listeChambres');
            exit;
        }
        $chambre = $controller->details($id);
        include('./vue/chambre/detailsChambre.php');
        break;
/** 
*    // Admin - Gestion des utilisateurs
*    case 'adminDashboard':
*        if (!isset($_SESSION['id_user']) || $_SESSION['id_user']['role_id'] !== 'admin') {
*            header('Location: index.php?page=login');
*            exit;
*        }
*        $adminController = new AdminController();
*        $users = $adminController->getAllUsers();
*        $chambres = $adminController->getAllRooms();
*        include('./vues/admin/admin_dashboard.php');
*        break;
*
*    case 'addUser':
*        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
*            $adminController = new AdminController();
*            $adminController->addUser($_POST);
*            header('Location: index.php?page=adminDashboard');
*        } else {
*            include('./vues/admin/addUser.php');
*        }
*        break;
*
*    case 'editUser':
*        $adminController = new AdminController();
*        $id = $_GET['id'] ?? null;
*        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
*            $adminController->editUser($id, $_POST);
*            header('Location: index.php?page=adminDashboard');
*        } else {
*            $user = $adminController->getUserById($id);
*            include('./vues/admin/editUser.php');
*        }
*        break;
*
*    case 'deleteUser':
*        $adminController = new AdminController();
*        $id = $_GET['id'] ?? null;
*        $adminController->deleteUser($id);
*        header('Location: index.php?page=adminDashboard');
*        break;
*
*    // Admin - Gestion des chambres
*    case 'addRoom':
*        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
*            $adminController = new AdminController();
*            $adminController->addRoom($_POST);
*            header('Location: index.php?page=adminDashboard');
*        } else {
*            include('./vues/admin/addRoom.php');
*        }
*        break;
*
*    case 'editRoom':
*        $adminController = new AdminController();
*        $id = $_GET['id'] ?? null;
*        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
*            $adminController->editRoom($id, $_POST);
*            header('Location: index.php?page=adminDashboard');
*        } else {
*            $room = $adminController->getRoomById($id);
*            include('./vues/admin/editRoom.php');
*        }
*        break;
*
*    case 'deleteRoom':
*        $adminController = new AdminController();
*        $id = $_GET['id'] ?? null;
*        $adminController->deleteRoom($id);
*        header('Location: index.php?page=adminDashboard');
*        break;
*/
    // Contact
    case 'contact':
        include('./vue/contact/form.php');
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
        if (!isset($_SESSION['id_user']) || $_SESSION['id_user']['role_id'] !== 'admin') {
            header('Location: index.php?page=login');
            exit;
        }
        $contactController = new ContactController();
        $messages = $contactController->listMessages();
        include('./vues/contact/list.php');
        break;
    

    default:
        include('./vue/accueil.php');
        break;
}
