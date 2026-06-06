<?php
// app/Http/Requests/PropertyRequest.php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class PropertyRequest extends FormRequest
{
    public function authorize(): bool
    {
        if (! auth()->check()) {
            return false;
        }
        return in_array(auth()->user()->role, ['admin', 'agent', 'owner']);
    }

    protected function failedAuthorization(): never
    {
        throw new \Illuminate\Auth\Access\AuthorizationException(
            'Seuls les propriétaires, agents et administrateurs peuvent publier une annonce.'
        );
    }

    public function rules(): array
    {
        return [
            'title'           => 'required|string|max:255',
            'description'     => 'nullable|string|min:20',
            'price'           => 'required|numeric|min:0',
            'area'            => 'nullable|numeric|min:0',
            'type'            => 'required|in:house,apartment,studio,room,colocation,land,office',
            'rooms'           => 'nullable|integer|min:1|max:50',
            'bedrooms'        => 'nullable|integer|min:0|max:20',
            'bathrooms'       => 'nullable|integer|min:0|max:20',
            'address'         => 'required|string|max:500',
            'city'            => 'required|string|max:100',
            'postal_code'     => 'nullable|string|max:10',
            'year_built'      => 'nullable|digits:4|integer|min:1900|max:'.date('Y'),
            'status'          => 'nullable|in:available,rented',
            'target_audience' => 'nullable|in:all,student,professional',
            'is_featured'     => 'nullable|boolean',
            'video_url'       => 'nullable|url|max:500',
            'features'        => 'nullable|array',
            'features.*'      => 'exists:property_features,id',
            'images'          => 'nullable|array|max:10',
            'images.*'        => 'image|mimes:jpg,jpeg,png,webp|max:5120',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required'       => 'Le titre est obligatoire.',
            'description.min'      => 'La description doit comporter au moins 20 caractères.',
            'price.required'       => 'Le loyer mensuel est obligatoire.',
            'price.numeric'        => 'Le loyer doit être un nombre.',
            'type.required'        => 'Le type de logement est obligatoire.',
            'type.in'              => 'Type invalide.',
            'address.required'     => "L'adresse est obligatoire.",
            'city.required'        => 'La ville est obligatoire.',
            'status.in'            => 'Statut invalide.',
            'target_audience.in'   => 'Audience invalide.',
            'images.*.image'       => 'Chaque fichier doit être une image.',
            'images.*.max'         => 'Chaque image ne doit pas dépasser 5 Mo.',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_featured'     => $this->boolean('is_featured'),
            'status'          => $this->input('status', 'available'),
            'target_audience' => $this->input('target_audience', 'all'),
        ]);
    }
}