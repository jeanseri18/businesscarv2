<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class InscriptionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'=>['required', 'string', 'max:255'],
            'email' =>['required', 'string', 'email:rfc,dns', 'max:255', 'unique:users,email'],
            'phone' =>['required', 'string', 'max:20'],
            'country'=>['required', 'string', 'max:100'],
            'nationality'=>['required', 'string', 'max:100'],
            'role'=>['required', 'string', Rule::in(['entreprise', 'commercial'])],
            'password'=>['required', 'string', 'confirmed', Password::min(8)],
            'accept_terms'=>['required', 'accepted'],
            'code_commercial'=>['nullable', 'string', 'max:20',
                // si le role est commercial alors le code_commercial est requis 
                // Rule::requiredIf(fn () => $this->role === 'commercial'),
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Le nom est obligatoire.',
            'email.required' => 'L\'email est obligatoire.',
            'email.email' => 'L\'email doit être valide (ex: adresse@domaine.com).',
            'email.unique' => 'Cet email est déjà utilisé par un autre utilisateur.',
            'phone.required' => 'Le numéro de téléphone est obligatoire.',
            'country.required' => 'Le pays est obligatoire.',
            'nationality.required' => 'La nationalité est obligatoire.',
            'role.required' => 'Le rôle est obligatoire.',
            'role.in' => 'Le rôle doit être soit commercial soit entreprise.',
            'accept_terms.accepted' => 'Veuillez accepter les conditions.',
            'password.required' => 'Le mot de passe est obligatoire.',
            'password.confirmed' => 'Les mots de passe ne sont pas identiques.',
            'password.min' => 'Le mot de passe doit contenir minimum huit caractères.',
        ];
    }

}
