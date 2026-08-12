<?php
class User
{
    /**
     * The database object
     *
     * @var object $db
     */
    private $db;

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        $this->db = new Database;
    }

    /**
     * Find user by email
     *
     * @param string $email The email
     *
     * @return bool
     */
    public function findUserByEmail(string $email) : bool
    {
        $this->db->query("SELECT * FROM users WHERE email = :email");
        $this->db->bind(':email', $email);
        $row = $this->db->single();

        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Register user
     *
     * @param array $data The data
     *
     * @return bool
     */
    public function registerUser(array $data) : bool
    {
        $this->db->query('INSERT INTO users (name, email, password) VALUES (:name, :email, :password)');
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Login user
     *
     * @param string $email    The email
     * @param string $password The password
     *
     * @return bool|object
     */
    public function login(string $email, string $password) : bool|object
    {
        $this->db->query("SELECT * FROM users WHERE email = :email");
        $this->db->bind(':email', $email);
        $row = $this->db->single();

        if (password_verify($password, $row->password)) {
            return $row;
        } else {
            return false;
        }
    }

    /**
     * Get user by id
     *
     * @param int $id The id
     *
     * @return object
     */
    public function getUser(int $id)
    {
        $this->db->query("SELECT * FROM users WHERE id = :id");
        $this->db->bind(':id', $id);
        $row = $this->db->single();

        return $row;
    }
}
