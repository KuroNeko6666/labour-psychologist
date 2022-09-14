<?php

namespace App\Policies;

use App\Models\Jadwal;
use App\Models\Psychologist;
use Illuminate\Auth\Access\HandlesAuthorization;

class JadwalPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\Psychologist  $psychologist
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(Psychologist $psychologist)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\Psychologist  $psychologist
     * @param  \App\Models\Jadwal  $jadwal
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Psychologist $psychologist, Jadwal $jadwal)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\Psychologist  $psychologist
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(Psychologist $psychologist)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\Psychologist  $psychologist
     * @param  \App\Models\Jadwal  $jadwal
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Psychologist $psychologist, Jadwal $jadwal)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\Psychologist  $psychologist
     * @param  \App\Models\Jadwal  $jadwal
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Psychologist $psychologist, Jadwal $jadwal)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\Psychologist  $psychologist
     * @param  \App\Models\Jadwal  $jadwal
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(Psychologist $psychologist, Jadwal $jadwal)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\Psychologist  $psychologist
     * @param  \App\Models\Jadwal  $jadwal
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(Psychologist $psychologist, Jadwal $jadwal)
    {
        //
    }
}
