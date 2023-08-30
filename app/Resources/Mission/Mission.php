<?php

namespace App\Resources\Mission;

use Illuminate\Http\Resources\Json\JsonResource;

class Mission extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'parolaCruciverba' => $this->parola_cruciverba,
            'selfieFesteggiato' => $this->selfie_festeggiato,
            'selfieAngolo' => $this->selfie_angolo,
            'brindisi' => $this->brindisi,
            'videoBrindisi' => $this->video_brindisi,
            'dedica' => $this->dedica,
            'indovinello' => $this->indovinello,
            'indovinelloDue' => $this->indovinello_due,
            'punteggio' => $this->punteggio,
            'date' => $this->date,
        ];
    }
}
