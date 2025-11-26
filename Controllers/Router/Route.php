<?php
namespace Controllers\Router;

// Classe abstraite mère pour toutes les routes définies dans /Router/Route
abstract class Route
{
    /**
     * Méthode principale appelée par le Router
     * Elle redirige vers la méthode get() ou post() selon la méthode HTTP.
     *
     * @param array $params Paramètres passés (ex: $_GET ou $_POST)
     * @param string $method Méthode HTTP (GET ou POST)
     */
    public function action(array $params = [], string $method = 'GET')
    {
        if ($method === 'POST') {
            return $this->post($params); // Appelle la méthode post() si POST
        }
        return $this->get($params); // Sinon GET par défaut
    }

    /**
     * Méthodes que chaque classe enfant doit implémenter.
     * Elles définissent le comportement d'une route en GET ou POST.
     */
    abstract public function get(array $params = []);
    abstract public function post(array $params = []);

    /**
     * Méthode utilitaire pour récupérer un paramètre avec vérification.
     *
     * @param array $array Le tableau source (GET ou POST)
     * @param string $paramName Nom du paramètre à chercher
     * @param bool $canBeEmpty Définit si la valeur peut être vide
     *
     * @return mixed La valeur du paramètre si présente et valide
     * @throws \Exception Si le paramètre est absent ou vide (selon le cas)
     */
    protected function getParam(array $array, string $paramName, bool $canBeEmpty = true)
    {
        if (isset($array[$paramName])) {
            if (!$canBeEmpty && empty($array[$paramName])) {
                throw new \Exception("Paramètre '$paramName' vide");
            }
            return $array[$paramName]; // OK : paramètre trouvé
        } else {
            throw new \Exception("Paramètre '$paramName' absent");
        }
    }
}
