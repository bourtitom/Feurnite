<?php

class User
{
    //DECLARATION DES ATTRIBUTS DE LA CLASSE
    private int $userId;
    private string $userPseudo;
    private string $userMail;
    private string $userPassword;
    private int $userCode;



    public function __construct(int $userId, string $userPseudo, string $userMail, string $userPassword, int $userCode)
    {
        $this->setUserId($userId);
        $this->setUserPseudo($userPseudo);
        $this->setUserMail($userMail);
        $this->setUserPassword($userPassword);
        $this->setUserCode($userCode);
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @param int $userId
     */
    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    /**
     * @return string
     */
    public function getUserPseudo(): string
    {
        return $this->userPseudo;
    }

    /**
     * @param string $userPseudo
     */
    public function setUserPseudo(string $userPseudo): void
    {
        $this->userPseudo = $userPseudo;
    }

    /**
     * @return string
     */
    public function getUserMail(): string
    {
        return $this->userMail;
    }

    /**
     * @param string $userMail
     */
    public function setUserMail(string $userMail): void
    {
        $this->userMail = $userMail;
    }

    /**
     * @return string
     */
    public function getUserPassword(): string
    {
        return $this->userPassword;
    }

    /**
     * @param string $userPassword
     */
    public function setUserPassword(string $userPassword): void
    {
        $this->userPassword = $userPassword;
    }

    /**
     * @return int
     */
    public function getUserCode(): int
    {
        return $this->userCode;
    }

    /**
     * @param int $userCode
     */
    public function setUserCode(int $userCode): void
    {
        $this->userCode = $userCode;
    }


}