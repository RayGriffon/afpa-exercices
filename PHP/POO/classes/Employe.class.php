<?php 

class Employe{

    private $_nom;
    private $_prenom;
    private $_dateEmbauche;
    private $_poste;
    private $_salaire;
    private $_service;
    private $_magasin;
    private $_ageEnfant = array();

    function __construct($_nom,$_prenom,$_dateEmbauche,$_poste,$_salaire,$_service, $_magasin,$_ageEnfant)
    {
        $this->_nom=$_nom;
        $this->_prenom=$_prenom;
        $this->_dateEmbauche=$_dateEmbauche;
        $this->_poste=$_poste;
        $this->_salaire=$_salaire;
        $this->_service=$_service;
        $this->_magasin=$_magasin;
        $this->_ageEnfant=$_ageEnfant;
    }

    /**
     * Get the value of _nom
     */ 
    public function get_nom()
    {
        return $this->_nom;
    }

    /**
     * Set the value of _nom
     *
     * @return  self
     */ 
    public function set_nom($_nom)
    {
        $this->_nom = $_nom;

        return $this;
    }

    /**
     * Get the value of _prenom
     */ 
    public function get_prenom()
    {
        return $this->_prenom;
    }

    /**
     * Set the value of _prenom
     *
     * @return  self
     */ 
    public function set_prenom($_prenom)
    {
        $this->_prenom = $_prenom;

        return $this;
    }

    /**
     * Get the value of _dateEmbauche
     */ 
    public function get_dateEmbauche()
    {
        return $this->_dateEmbauche;
    }

    /**
     * Set the value of _dateEmbauche
     *
     * @return  self
     */ 
    public function set_dateEmbauche($_dateEmbauche)
    {
        $this->_dateEmbauche = $_dateEmbauche;

        return $this;
    }

    /**
     * Get the value of _poste
     */ 
    public function get_poste()
    {
        return $this->_poste;
    }

    /**
     * Set the value of _poste
     *
     * @return  self
     */ 
    public function set_poste($_poste)
    {
        $this->_poste = $_poste;

        return $this;
    }

    /**
     * Get the value of _salaire
     */ 
    public function get_salaire()
    {
        return $this->_salaire;
    }

    /**
     * Set the value of _salaire
     *
     * @return  self
     */ 
    public function set_salaire($_salaire)
    {
        $this->_salaire = $_salaire;

        return $this;
    }

    /**
     * Get the value of _service
     */ 
    public function get_service()
    {
        return $this->_service;
    }

    /**
     * Set the value of _service
     *
     * @return  self
     */ 
    public function set_service($_service)
    {
        $this->_service = $_service;

        return $this;
    }

        /**
     * Get the value of _magasin
     */ 
    public function get_magasin()
    {
        return $this->_magasin;
    }

    /**
     * Set the value of _magasin
     *
     * @return  self
     */ 
    public function set_magasin($_magasin)
    {
        $this->_magasin = $_magasin;

        return $this;
    }


    /**
     * Get the value of _ageEnfant
     */ 
    public function get_ageEnfant()
    {
        return $this->_ageEnfant;
    }

    /**
     * Set the value of _ageEnfant
     *
     * @return  self
     */ 
    public function set_ageEnfant($_ageEnfant)
    {
        $this->_ageEnfant = $_ageEnfant;

        return $this;
    }

    public function anciennete() {
        $date_embauche = new DateTime($this->_dateEmbauche);
        $date_now = new DateTime();
        $diff = $date_now->diff($date_embauche);
        return $diff->y;
    }

    public function prime_annuelle() {
        $prime = $this->_salaire * 0.05 + $this->_salaire * $this->anciennete() * 0.02;
        return $prime;
    }

    public function transfert_bancaire() {
        $prime = $this->prime_annuelle();
        $date_now = new DateTime();
        $date_limite = new DateTime("last day of November");

        if ($date_now > $date_limite) {
            $message = "La prime de " . $this->_prenom . " " . $this->_nom . " de " . $prime . " euros a été envoyée à la banque.";
            return $message;
        } else {
            $message = "La prime de " . $this->_prenom . " " . $this->_nom . " ne peut pas encore être versée.";
            return $message;
        }
    }

    public function elligibleChequeVacance(){
        $estElligible = false;
        if ($this->anciennete()>1){
            $estElligible = true;
        }
        return $estElligible;
    }

    public function montantChequeNoel(){
        if ($this->elligibleChequeVacance() && $this->_ageEnfant != null){
            echo "rentre dans la boucle<br>";
                for ($i=0; $i<count($this->_ageEnfant) ; $i++) { 
                    if($this->_ageEnfant[$i]<11){
                        echo "20 euros<br>";
                    }else if(10<$this->_ageEnfant[$i] && $this->_ageEnfant[$i]<16){
                        echo "30 euros<br>";
                    }else if(16<$this->_ageEnfant[$i] && $this->_ageEnfant[$i]<19){
                        echo "50 euros<br>";
                    }
                }
        }else{
            echo "Pas d'enfant pas de chocolat";
        }
    }



}
