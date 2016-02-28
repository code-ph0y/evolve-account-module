<?php

namespace AccountModule\Entity;

class UserAccount
{
    protected $id            = null;
    protected $user_id       = null;
    protected $profile_image = null;

    protected $address_1     = null;
    protected $address_2     = null;
    protected $city          = null;
    protected $state         = null;
    protected $country       = null;
    protected $zip_code      = null;

    protected $mobile        = null;

    public function __construct($data = array())
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
    }

    /**
     * Get the value of Id
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of User Id
     *
     * @return mixed
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * Get the value of Address 1
     *
     * @return mixed
     */
    public function getAddress1()
    {
        return $this->address_1;
    }

    /**
     * Get the value of Address 2
     *
     * @return mixed
     */
    public function getAddress2()
    {
        return $this->address_2;
    }

    /**
     * Get the value of City
     *
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Get the value of State
     *
     * @return mixed
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Get the value of Country
     *
     * @return mixed
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Get the value of Zip Code
     *
     * @return mixed
     */
    public function getZipCode()
    {
        return $this->zip_code;
    }

    /**
     * Get the value of Mobile
     *
     * @return mixed
     */
    public function getMobile()
    {
        return $this->mobile;
    }

    /**
     * Get the value of Profile Image
     *
     * @return mixed
     */
    public function getProfileImage()
    {
        return $this->profile_image;
    }
}
