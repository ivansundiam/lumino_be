<?php

namespace App\Traits;

use Illuminate\Http\Response;

trait ApiResponse
{
    /**
     * Generic success response
     */
    protected function success($data = null, $message = 'Success', int $status = Response::HTTP_OK) {
        return response()->json([
            'status' => true,
            'data' => $data,
            'message' => $message
        ], $status);
    }

    /**
     * Generic error response
     */
    protected function error($message = 'Something went wrong', int $status = Response::HTTP_BAD_REQUEST, $data = null) {
        return response()->json([
            'status' => false,
            'errors' => $data,
            'message' => $message
        ], $status);
    }

    /**
    * Validation error response
    */
    protected function validationError($errors, $message = 'Validation failed')
    {
        return $this->error($message, Response::HTTP_UNPROCESSABLE_ENTITY, $errors);
    }

    /**
    * Not found response
    */
    protected function notFound($message = 'Resource not found')
    {
        return $this->error($message, Response::HTTP_NOT_FOUND);
    }

    /**
    * Unauthorized response
    */
    protected function unauthorized($message = 'Unauthorized access')
    {
        return $this->error($message, Response::HTTP_UNAUTHORIZED);
    }

    /**
    * Forbidden response
    */
    protected function forbidden($message = 'Forbidden action')
    {
        return $this->error($message, Response::HTTP_FORBIDDEN);
    }

    /**
    * Created response
    */
    protected function created($data = null, $message = 'Created successfully')
    {
        return $this->success($data, $message, Response::HTTP_CREATED);
    }
}
