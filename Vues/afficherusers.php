<?php
require_once 'Modeles/monPdo.php';
require_once 'Modeles/user.class.php';

MonPdo::checkSessionAndRedirect();
$userRole = MonPdo::getUserRole($_SESSION['user_id']);
$lesUsers = [];

if ($userRole == 'admin') {
    $pdo = MonPdo::getInstance();
    $stmt = $pdo->prepare('SELECT ID, USERNAME, ROLE FROM users');
    $stmt->execute();
    $lesUsers = $stmt->fetchAll(PDO::FETCH_OBJ);
} else {
    echo "Access Denied";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conservatoire - Users</title>
    <script defer src='https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js'></script>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css'>
    <style>
        .table-responsive {
            margin: 0;
        }

        .adminbutt {
            white-space: nowrap;
            width: 1%;
        }

        .adminbutt .btn {
            margin-right: 0.25rem;
        }

        @media (max-width: 767.98px) {
            .adminbutt {
                display: flex;
                flex-direction: column;
                width: auto;
            }

            .adminbutt .btn {
                width: 100%;
                margin-right: 0;
                margin-bottom: 0.25rem;
            }

            .adminbutt .btn:last-child {
                margin-bottom: 0;
            }

            .position-relative {
                flex: center;
            }
        }
    </style>
    <script>
        function confirmDelete(url, username) {
            if (confirm(`Etes vous sur de vouloir supprimer ${username}?`)) {
                window.location.href = url;
            }
        }
    </script>
</head>

<body>
<?php include("header/header.php") ?>
<div class="position-relative mt-5 mb-3">
    <h2 class="d-flex justify-content-center mt-5" id="tit_h">Users</h2>
</div>
    <div class="container-fluid position-relative mt-3">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th class="table_h" scope="col">ID</th>
                        <th class="table_h" scope="col">Username</th>
                        <th class="table_h" scope="col">Role</th>
                        <th class="table_h" scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($lesUsers as $user) {
                        echo "<tr>";
                        echo "<td class='table_h'>" . htmlspecialchars($user->ID, ENT_QUOTES, 'UTF-8') . "</td>";
                        echo "<td class='table_h'>" . htmlspecialchars($user->USERNAME, ENT_QUOTES, 'UTF-8') . "</td>";
                        echo "<td class='table_h'>" . htmlspecialchars($user->ROLE, ENT_QUOTES, 'UTF-8') . "</td>";
                        echo "<td class='adminbutt'>";
                        echo "<a href='#' onclick=\"confirmDelete('index.php?uc=user&action=supprimer&id=" . htmlspecialchars($user->ID, ENT_QUOTES, 'UTF-8') . "', '" . htmlspecialchars($user->USERNAME, ENT_QUOTES, 'UTF-8') . "')\" class='btn btn-danger btn-sm'>Supprimer</a>";
                        echo "<a href='index.php?uc=user&action=editer_form&id=" . htmlspecialchars($user->ID, ENT_QUOTES, 'UTF-8') . "' class='btn btn-warning btn-sm'>Modifier</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                    ?>
                    <tr>
                        <td colspan="4" class="adminbutt">
                            <a href='index.php?uc=user&action=ajout_form' class='btn btn-primary btn-sm'>Ajouter un utilisateur</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
