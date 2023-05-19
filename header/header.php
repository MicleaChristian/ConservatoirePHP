<div class="relative">
                        <form class="position-absolute top-50 start-50 translate-middle" action="index.php" method="POST">
                            <input type="hidden" name="uc" value="logout">
                            <input type="hidden" name="action" value="deconnexion">
                            <ul class="navbar-nav">
                                <li class="d-flex">
                                    <p class="me-5"> Bonjour <?php echo $_SESSION['user_id']; ?> </p>
                                    <button type="submit" class="btn btn-danger">Déconnexion</button>
                                </li>
                            </ul>
                        </form>
                    </div>
