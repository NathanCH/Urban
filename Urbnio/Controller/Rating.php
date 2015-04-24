<?php
namespace Urbnio\Controller;
use Urbnio\Lib\Controller;
use Urbnio\Helper\Validate;


class Rating extends Controller {

    public function submit($rating = null) {
        if($rating) {
            $validate_data = array(
                'rating' => $rating
            );

            $items = array(
                'rating' => array(
                    'required' => true,
                    'max' => 1,
                    'positive_integer' => true
                ),
            );

            $validate = new Validate;
            $validation = $validate->check($validate_data, $items);

            if($validation->passed()) {
                try {
                    $ratings_model = $this->loadModel('RatingsModel');
                    $ratings_model->add_rating(array(
                        'category' => 'region',
                        'item_id' => 1,
                        'rating' => $rating,
                    ));
                    header('Content-Type: application/json');
                    echo json_encode(array(
                        'success' => true,
                    ));
                } catch (Exception $e) {
                    return false;
                }
            }

            return false;
        }
    }

}