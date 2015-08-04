<?php

namespace App\Http\Requests;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exception\HttpResponseException;
use Illuminate\Http\JsonResponse;

abstract class Request extends FormRequest
{
    /**
     * Get the proper failed validation response for the request.
     *
     * @param  array $errors
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function response (array $errors)
    {
        if ($this->ajax() || $this->wantsJson()) {
            foreach ($errors as $index => $error) {
                $errors[$index] = ucfirst($error);
            }
            $data = [
                'exito'   => FALSE,
                'titulo' => 'Ups...',
                'texto' => 'Hay problemas con los datos',
                'url'     => '',
                'errores' => $errors
            ];

            return new JsonResponse($data, 422);
        }

        return $this->redirector->to($this->getRedirectUrl())->withInput($this->except($this->dontFlash))->withErrors(
            $errors,
            $this->errorBag
        );
    }

    /**
     * Format the errors from the given Validator instance.
     *
     * @param  \Illuminate\Contracts\Validation\Validator $validator
     *
     * @return array
     */
    protected function formatErrors (Validator $validator)
    {
        return $validator->errors()->all();
    }

    /**
     * @param \Illuminate\Contracts\Validation\Validator $validator
     *
     * @throws \App\Http\Requests\HttpResponseException
     * @return mixed
     */
    protected function failedValidation (Validator $validator)
    {
        throw new HttpResponseException(
            $this->response(
                $this->formatErrors($validator)
            )
        );
    }
}
