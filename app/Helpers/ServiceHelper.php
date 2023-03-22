<?php

namespace App\Helpers;

use App\Http\Resources\User\UserResource;
use Symfony\Component\HttpFoundation\Response;

/**
 * ServiceHelper
 *
 * Helper Class for classes in the App\Services namespace
 * Mainly used to return arrays that can be used for the body of a response
 *
 *
 * @package     Utilities
 * @author      Hoan Ngoc Le <hoanngocle.93@gmail.com>
 */
class ServiceHelper
{
    /**
     * Helper to indicate that the login authentication has succeeded
     *
     * @param string $plainTextToken
     *
     * @return array
     */
    public static function auth(string $plainTextToken): array
    {
        return
            [
                'success'   => true,
                'code'      => Response::HTTP_OK,
                'token'     => $plainTextToken,
                'user'      => new UserResource(auth()->user())
            ];
    }

    /**
     * Helper to indicate that the login authentication has failed
     *
     * @return array
     */
    public static function authFailed(): array
    {
        return
            [
                'success'   => false,
                'code'      => Response::HTTP_UNAUTHORIZED,
                'message'   => __('auth.login.error')
            ];
    }

    /**
     * Return message error or success only
     */
    public static function message($message): array
    {
        return
            [
                'success'   => true,
                'code'      => Response::HTTP_OK,
                'message'   => $message
            ];
    }

    /**
     * Return data after create, update or delete
     */
    public static function data($data): array
    {
        return
            [
                'success'   => true,
                'code'      => Response::HTTP_OK,
                'data'      => $data
            ];
    }

    /**
     *
     */
    public static function paginatedData($data): array
    {
        return
            [
                'success'       => true,
                'code'          => Response::HTTP_OK,
                'total'         => $data->total(),
                'per_page'      => $data->perPage(),
                'current_page'  => $data->currentPage(),
                'last_page'     => $data->lastPage(),
                'data'          => $data->getCollection()
            ];
    }

    /**
     *
     */
    public static function created($name): array
    {
        return
            [
                'success'   => true,
                'code'      => Response::HTTP_CREATED,
                'message'   => $name . ' has been created successfully.'
            ];
    }

    /**
     *
     */
    public static function createdWithData($name, $data): array
    {
        return
            [
                'success'   => true,
                'code'      => Response::HTTP_CREATED,
                'data'      => $data,
                'message'   => $name . ' has been created successfully.'
            ];
    }

    /**
     *
     */
    public static function updated($name): array
    {
        return
            [
                'success'   => true,
                'code'      => Response::HTTP_OK,
                'message'   => $name . ' has been updated successfully.'
            ];
    }

    /**
     * Updated with data return
     */
    public static function updatedWithData($name, $data): array
    {
        return
            [
                'success'   => true,
                'code'      => Response::HTTP_CREATED,
                'data'      => $data,
                'message'   => $name . ' has been updated successfully.'
            ];
    }

    /**
     *
     */
    public static function deleted($name): array
    {
        return
            [
                'success'   => true,
                'code'      => Response::HTTP_OK,
                'message'   => $name . ' has been deleted successfully.'
            ];
    }

    /**
     *
     */
    public static function unauthorized($name): array
    {
        return
            [
                'success'   => false,
                'code'      => Response::HTTP_UNAUTHORIZED,
                'message'   => 'Failed to authenticate access for ' . $name
            ];
    }

    /**
     *
     */
    public static function forbidden($name): array
    {
        return
            [
                'success'   => false,
                'code'      => Response::HTTP_FORBIDDEN,
                'message'   => 'Access forbidden for ' . $name
            ];
    }

    /**
     *
     */
    public static function notFound($name): array
    {
        return [
            'success'   => false,
            'code'      => Response::HTTP_NOT_FOUND,
            'message'   => $name . ' not found.'
        ];
    }

    /**
     *
     */
    public static function deleteConflict($name): array
    {
        return [
            'success'   => false,
            'code'      => Response::HTTP_CONFLICT,
            'message'   => 'Unable to delete ' . $name . ' as it is still referenced by other records.'
        ];
    }

    /**
     *
     */
    public static function invalidValueError($name): array
    {
        return [
            'success'   => false,
            'code'      => Response::HTTP_UNPROCESSABLE_ENTITY,
            'message'   => $name . ' is invalid.'
        ];
    }

    /**
     *
     */
    public static function queryError($errorCode, $e = null): array
    {
        if ($e && config('app.debug')) {
            return [
                'success'           => false,
                'code'              => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message'           => 'A DB Error has occured',
                'query_error_code'  => $errorCode,
                'error'             => [
                    'code'      => $e->getCode(),
                    'message'   => $e->getMessage(),
                    'line'      => $e->getLine(),
                ]
            ];
        } else {
            return [
                'success'           => false,
                'code'              => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message'           => 'A DB Error has occured',
                'query_error_code'  => $errorCode
            ];
        }
    }

    /**
     *
     */
    public static function serverError($e = null): array
    {
        if ($e && config('app.debug')) {
            return [
                'success'   => false,
                'code'      => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message'   => 'An Internal Server Error has occured',
                'error'     => [
                    'code'      => $e->getCode(),
                    'message'   => $e->getMessage(),
                    'line'      => $e->getLine(),
                ]
            ];
        } else {
            return [
                'success' => false,
                'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => 'An Internal Server Error has occured',
            ];
        }
    }

    /**
     * Return a custom error with message
     */
    public static function error($code, $message, $e = null): array
    {
        // Return exception details if DEBUG mode is set to true and
        // the exception instance is not null
        if ($e && config('app.debug')) {
            return [
                'success'   => false,
                'code'      => $code,
                'message'   => $message,
                'error'     => [
                    'code'      => $e->getCode(),
                    'message'   => $e->getMessage(),
                    'line'      => $e->getLine(),
                ],
            ];
        } else {
            return [
                'success'   => false,
                'code'      => $code,
                'message'   => $message,
            ];
        }
    }

    /**
     * Return response body indicating a successful request
     * @param int $code
     * @param string $message
     * @param null $data
     * @param null $pagination
     * @return array
     */
    public static function success(int $code = Response::HTTP_OK, $message = '', $data = null, $pagination = null)
    {
        // Construct response body
        $body = [
            'success'   => true,
            'code'      => $code
        ];

        // Add message key and value if not empty
        if ($message !== '') {
            $body['message'] = $message;
        }

        // Add data key and value if not empty
        if ($data) {
            $body['data'] = $data;
        }

        // Add pagination key and value if not empty
        if ($pagination) {
            $body['pagination'] = $pagination;
        }

        return $body;
    }

    /**
     * Return response body indicating a failed request
     *
     * @param int $code
     * @param string $message
     * @param null $data
     * @param null $exception
     * @param null $errors
     *
     * @return array
     */
    public static function failed(int $code = Response::HTTP_BAD_REQUEST, string $message = 'An error has occured', $data = null, $exception = null, $errors = null)
    {
        // Construct response body
        $body = [
            'success'   => false,
            'code'      => $code
        ];

        // Add message key and value if not empty
        $body['message'] = $message;

        // Add data key and value if not empty
        if ($data) {
            $body['data'] = $data;
        }

        if ($exception && config('app.debug')) {
            $body['exception'] = $exception;
        }

        if ($errors) {
            $body['errors'] = $errors;
        }

        return $body;
    }
}
