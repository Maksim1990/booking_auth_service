<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="CreateUser",
 *     title="Create User",
 *     required={"first_name", "email", "password"},
 * 	@OA\Property(
 *         property="first_name",
 *         type="string"
 *     ),
 * 	@OA\Property(
 *         property="last_name",
 *         type="string"
 *     ),
 *  @OA\Property(
 *         property="email",
 *         type="string"
 *      ),
 *  @OA\Property(
 *         property="country",
 *         type="string"
 *    ),
 *  @OA\Property(
 *         property="phone",
 *         type="string"
 *    ),
 *  @OA\Property(
 *         property="type",
 *         type="string"
 *     ),
 *  @OA\Property(
 *         property="password",
 *         type="string"
 *     ),
 * )
 */
class StoreUserRequest extends FormRequest
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
            'email'      => 'required|email|unique:users|max:255',
            'first_name' => 'required',
            'password'   => 'required',
        ];
    }
}
