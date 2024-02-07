<?php

namespace App\Models;

use App\Exceptions\SlidersExceptions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sliders extends Model
{
    use HasFactory;

    /**
     * Referencia a tabela do modelo.
     *
     * @var string
     */
    protected $table = "sliders";

    /**
     * Referencia os campos com inserção em massa.
     *
     * @var array
     */
    protected $fillable = [
        'sliders_hash',
        'sliders_size',
        'sliders_image',
        'sliders_format',
        'sliders_active',
    ];

    /**
     * Ativa ou desativa um slider
     *
     * @param integer $id
     * @return boolean
     */
    public function activeAndDeactive(int $id): bool
    {
        // Recuperando slider. 
        $slider = $this->where('id', $id)->first();
        if ($slider->sliders_active) {
            $actived = $this->where('id', $id)->update(['sliders_active' => false]);
            if (!$actived) {
                throw new SlidersExceptions('Não foi possível desativar o slider. ');
            }
            return false;
        } else {
            $actived = $this->where('id', $id)->update(['sliders_active' => true]);
            if (!$actived) {
                throw new SlidersExceptions('Não foi possível desativar o slider. ');
            }
            return true;
        }
    }
}