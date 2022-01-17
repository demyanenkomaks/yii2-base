<?php
/**
 * The manifest of files that are local to specific environment.
 * This file returns a list of environments that the application
 * may be installed under. The returned data must be in the following
 * format:
 *
 * ```php
 * return [
 *         'path' => 'directory storing the local files',
 *         'skipFiles'  => [
 *             // list of files that should only copied once and skipped if they already exist
 *         ],
 *         'setWritable' => [
 *             // list of directories that should be set writable
 *         ],
 *         'setExecutable' => [
 *             // list of files that should be set executable
 *         ],
 *         'setCookieValidationKey' => [
 *             // list of config env that need to be inserted with automatically generated cookie validation keys
 *         ],
 *         'createSymlink' => [
 *             // list of symlinks to be created. Keys are symlinks, and values are the targets.
 *         ],
 * ];
 * ```
 */
return [
    'dev' => [
        'path' => 'dev',
        'setWritable' => [
            'backend/runtime',
            'backend/web/assets',
            'console/runtime',
            'frontend/runtime',
            'web/assets'
        ],
        'setExecutable' => [
            'yii',
            'yii_test',
        ],
        'setCookieValidationKey' => [
            'COOKIE_VALIDATION_KEY_BACKEND',
            'COOKIE_VALIDATION_KEY_FRONTEND',
        ],
        'createSymlink' => [
            'backend/web/uploads' => 'web/uploads',
            'web/backend' => 'backend/web'
        ],
    ],
    'prod' => [
        'path' => 'prod',
        'setWritable' => [
            'backend/runtime',
            'backend/web/assets',
            'console/runtime',
            'frontend/runtime',
            'web/assets'
        ],
        'setExecutable' => [
            'yii',
        ],
        'setCookieValidationKey' => [
            'COOKIE_VALIDATION_KEY_BACKEND',
            'COOKIE_VALIDATION_KEY_FRONTEND',
        ],
        'createSymlink' => [
            'backend/web/uploads' => 'web/uploads',
            'web/backend' => 'backend/web'
        ],
    ],
];
