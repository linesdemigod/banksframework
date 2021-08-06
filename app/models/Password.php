<?php
class Password
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    //update the user code 
    public function updateCode($email, $code)
    {

        // Prepare Query
        $this->db->query('UPDATE users SET code = :code WHERE email = :email');

        // Bind Values
        $this->db->bind(':code', $code);
        $this->db->bind(':email', $email);

        //Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    //select the code
    public function reset($code)
    {
        $this->db->query('SELECT * FROM users WHERE code = :code');
        $this->db->bind(':code', $code);

        $row = $this->db->single();

        //Check Rows
        if ($this->db->rowCount() > 0) {
            return  $row;
        } else {
            return false;
        }
    }

    // update the forgotten password 
    public function updatePassword($password, $code, $email)
    {
        $this->db->query('UPDATE users SET code = :code, password = :password WHERE email = :email');

        $this->db->bind('code', $code);
        $this->db->bind('password', $password);
        $this->db->bind('email', $email);

        //Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
