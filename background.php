<?php

    class Controller_Background extends Controller_Rest {

        /*
         * Set variable path
         *
         * @var string
         */
        protected $path = "assets/img/transitions/";

        /*
         * Return success json
         *
         * @param array
         * @return json
         */
        public function success($data) {
            $success = [
                'success' => true,
                'code' => 200
            ];
            $result = array_merge($data, $success);
            return $this->response($result, 200);
        }

        /*
         * Return error json
         *
         * @param array
         * @return json
         */
        public function error($data) {
            $error = [
                'error' => true,
                'code' => 400
            ];
            $result = array_merge($data, $error);
            return $this->response($result, 400);
        }

        /*
         * Return image real path
         *
         * @param string
         * @return string
         */
        public function return_real_path($image = null) {
            // Check if folder exists
            if(\Input::get('folder')) {
                // Create real path
                $path = $this->path.Input::get('folder').'/';
                $return = (isset($image)) ? $path.$image : $path;

                return $return;
            } else {
                // Throw error if folder is not defined
                throw new Exception('No folder defined');
            }
        }

        /*
         * Return images
         */
        public function get_images() {
            try {
                $images = \File::read_dir($this->return_real_path(), 0, array(
                    '\.png$' => 'file',
                    '\.jpg$' => 'file'
                ));
                if($images) {
                    $background = [];

                    foreach($images as $image) {
                        // Build up array with images
                        $background[] = $this->return_real_path($image);
                    }

                    // Return images
                    return $this->success(array(
                        'images' => $background
                    ));
                }
            } catch(Exception $e) {
                return $this->error(array(
                    'message' => $e->getMessage()
                ));
            }
        }

        /*
         * Parent before
         */
        public function before() {
            parent::before();

            // Check if its an Ajax request
            if(!\Input::is_ajax()) {
                throw new \HttpNotFoundException();
            }
        }

    }