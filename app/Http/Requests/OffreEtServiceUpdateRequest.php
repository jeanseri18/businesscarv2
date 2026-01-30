<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OffreEtServiceUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // L'utilisateur doit être connecté et recupéré depuis le token
        return $this->user() !== null;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'type'=>['required', Rule::in(['produit', 'service'])],
            'nom'=>['required', 'string'],
            'prix'=>['required', 'numeric'],
            'pdf_path'=>['nullable', 'file', 'mimes:pdf', 'max:5120'],
            'photo_path'=>['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'detail'=>['required', 'string']
        ];
    }

    public function messages(): array
    {
        return [
            'type.required' => 'Le type doit être obligatoirement spécifié.',
            'type.in' => 'Le type doit être un produit ou un service.',
            'nom.required' => 'Le nom est obligatoire.',
            'prix.required' => 'Le prix est obligatoire.',
            'prix.numeric' => 'Le prix doit avoir une valeur numérique.',
            'pdf_path.mimes' => 'Le fichier uploadé doit être un document de type pdf.',
            'pdf_path.max' => 'La taille du fichier ne doit pas excéder 5Mo.',
            'photo_path.mimes' => 'Le fichier uploadé doit être une image de type jpeg, png, jpg ou gif.',
            'photo_path.max' => 'La taille de l\'image ne doit pas excéder 2Mo.',
            'detail.required' => 'Le détail de l\'offre est obligatoire.',
        ];
    }
}
