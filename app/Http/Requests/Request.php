<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exception\HttpResponseException;
use Illuminate\Http\JsonResponse;

abstract class Request extends FormRequest
{

	/**
	 * 422 Unprocessable Entity
	 *
	 * @var int
	 */
	private $STATUS_CODE = 422;

	/**
	 * Get the proper failed validation response for the request.
	 *
	 * @param  array $errors
	 *
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function response(array $errors)
	{
		// Web APP
		if ($this->ajax() && $this->wantsJson())
		{
			foreach ($errors as $index => $error)
			{
				$errors[$index] = ucfirst($error);
			}
			$data = [
				'exito'   => false,
				'titulo'  => 'Ups...',
				'texto'   => 'Hay problemas con los datos',
				'url'     => '',
				'errores' => $errors
			];

			return new JsonResponse($data, $this->STATUS_CODE);
		}

		// API
		else if($this->wantsJson())
		{
			foreach ($errors as $index => $error)
			{
				$errors[$index] = [
					'detalles' => ucfirst($error)
				];
			}

			$data = [
				'mensaje'   => 'Datos inválidos',
				'errores' => $errors
			];

			return new JsonResponse($data, $this->STATUS_CODE, [], JSON_PRETTY_PRINT);
		}
		else {
			return $this->redirector->to($this->getRedirectUrl())->withInput($this->except($this->dontFlash))->withErrors(
				$errors,
				$this->errorBag
			);
		}

	}

	/**
	 * Format the errors from the given Validator instance.
	 *
	 * @param  \Illuminate\Contracts\Validation\Validator $validator
	 *
	 * @return array
	 */
	protected function formatErrors(Validator $validator)
	{
		return $validator->errors()->all();
	}

	/**
	 * @param \Illuminate\Contracts\Validation\Validator $validator
	 *
	 * @throws \App\Http\Requests\HttpResponseException
	 * @return mixed
	 */
	protected function failedValidation(Validator $validator)
	{
		throw new HttpResponseException(
			$this->response(
				$this->formatErrors($validator)
			)
		);
	}

	/**
	 * Get the response for a forbidden operation.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function forbiddenResponse()
	{
		if ($this->ajax() && $this->wantsJson())
		{
			$data = [
				'exito'  => false,
				'titulo' => 'No autorizado',
				'texto'  => 'No tienes permiso de hacer esta acción.'
			];

			return new JsonResponse($data, 403, [], JSON_PRETTY_PRINT);
		}
		else
		{
			return new Response('No tienes permiso de hacer esta acción.', 403);
		}
	}
}
