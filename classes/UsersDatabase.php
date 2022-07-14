<?php

require_once __DIR__ . "/Database.php";
require_once __DIR__ . "/User.php";

class UsersDatabase extends Database
{

    public function get_by_username($username)
    {

        $query = "SELECT * FROM users WHERE username = ?";

        $stmt = mysqli_prepare($this->conn, $query);

        $stmt->bind_param("s", $username);

        $stmt->execute();

        $result = $stmt->get_result();

        $db_user = mysqli_fetch_assoc($result);

        if ($db_user == null) {
            return null;
        }

        $user = new User($db_user["username"], $db_user["role"], $db_user["id"]);

        $user->set_password_hash($db_user["passwordHash"]);

        return $user;
    }

    // get all
    public function get_all()
    {
        $query = "SELECT * FROM users";

        $result = mysqli_query($this->conn, $query);

        $db_users = mysqli_fetch_all($result, MYSQLI_ASSOC);

        $users = [];
        foreach ($db_users as $db_user) {
            $user = new User($db_user["username"], $db_user["role"], $db_user["id"]);
            $users[] = $user;
        }
        return $users;
    }

    public function create(User $user)
    {
        $query = "INSERT INTO users (username, passwordHash, `role`) VALUES (?, ?, ?)";

        $stmt = mysqli_prepare($this->conn, $query);

        $stmt->bind_param("sss", $user->username, $user->get_password_hash(), $user->role);

        $success = $stmt->execute();

        return $success;
    }

    public function delete($id)
    {
        $query = "DELETE FROM users WHERE id = ?";

        $stmt = mysqli_prepare($this->conn, $query);

        $stmt->bind_param("i", $id);

        $success = $stmt->execute();

        return $success;
    }

    public function update($role, $id)
    {
        $query = "UPDATE users SET `role` = ? WHERE id = ?";

        $stmt = mysqli_prepare($this->conn, $query);

        $stmt->bind_param("si", $role, $id);

        $success = $stmt->execute();

        return $success;
    }

    //function to get google user id
    public function get_google_user_id(User $user)
    {
        //1. Kolla om användaren finns
        $db_user = $this->get_by_username($user->username); //email blir användarnamnet

        //2. Om inte, skapa användaren
        if ($db_user == null) {

            $query = "INSERT INTO users (username) VALUES (?)";

            $stmt = mysqli_prepare($this->conn, $query);

            $stmt->bind_param("s", $user->username);

            $success = $stmt->execute();

            if ($success) {
                //insert_id = IDt som skapas när vi skapar en ny användare
                $user->id = $stmt->insert_id;
            } else {
                var_dump($stmt->error);
                die("Error saving google user");
            }
        } else {
            //om användaren redan finns, spara den i user. För vi skickar IDt vidare sen
            $user = $db_user;
        }

        //3. Skicka tillbaka IDt
        return $user->id;
    }
}
