<?php
/**
 * Created by PhpStorm.
 * User: gvalero
 * Date: 05/12/2017
 * Time: 12:53
 */
namespace App\Http\Controllers\Lib\Team;

class TeamOrganiser
{
    public $team;
    public $incidents;
    public $achatsOrganiser;
    protected $incidentsOrganiser;

    /**
     * TeamOrganiser constructor.
     */
    public function __construct(IncidentOrganiser $incidentOrganiser, AchatsOrganiser $achatOrganiser)
    {
        $this->incidentsOrganiser = $incidentOrganiser;
        $this->achatsOrganiser = $achatOrganiser;
    }

    /**
     * @param $team
     * @return $this
     */
    public function setTeam($team)
    {
        $this->team = $team;

        return $this;
    }

    /**
     * @return $this
     */
    public function getIncidents()
    {
        $this->incidents = $this->incidentsOrganiser->getIncidents($this->team);

        return $this;
    }

    /**
     * @return $this
     */
    public function getAchats()
    {
        return  $this->achatsOrganiser->getAchats($this->team);
    }

}