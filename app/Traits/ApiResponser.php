<?php

namespace App\Traits;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\LengthAwarePaginator;

trait ApiResponser
{

	protected function successResponse($data, $message = null, $code = 200)
	{
		return response()->json([
			'success' => true,
			'message' => $message,
			'data' => $data
		], $code);
	}

	protected function successResponseListData($data, $message = null, $code = 200)
	{
		$paginatedData = $data->toArray();
		return response()->json([
			'success' => true,
			'message' => $message,
			'data' => $paginatedData["data"],
			"pagination" => [
				'total' => $paginatedData['total'],
				'per_page' => $paginatedData['per_page'],
				'current_page' => $paginatedData["current_page"],
				'next_page_link' => $paginatedData["next_page_url"],
				'previous_page_link' => $paginatedData["prev_page_url"]
			]
		], $code);
	}

	protected function errorResponse($message = null, $code , $errors = [])
	{
		return response()->json([
			'success' => false,
			'message' => $message,
			'errors' => $errors
		], $code);
	}
}
