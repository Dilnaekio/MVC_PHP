<?php

class Users{
    private $id;
    private $name;
    private $mail;
    private $pwd;
    private $role;

    public function __construct($id, $name, $mail, $pwd, $role)
    {
        $this->id = $id;
        $this->name = $name;
        $this->mail = $mail;
        $this->pwd = $pwd;
        $this->role = $role;
    }


    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return htmlspecialchars($this->id);
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return htmlspecialchars($this->name);
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of mail
     */ 
    public function getMail()
    {
        return htmlspecialchars($this->mail);
    }

    /**
     * Set the value of mail
     *
     * @return  self
     */ 
    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * Get the value of pwd
     */ 
    public function getPwd()
    {
        return htmlspecialchars($this->pwd);
    }

    /**
     * Set the value of pwd
     *
     * @return  self
     */ 
    public function setPwd($pwd)
    {
        $this->pwd = $pwd;

        return $this;
    }

    /**
     * Get the value of role
     */ 
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set the value of role
     *
     * @return  self
     */ 
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }
}