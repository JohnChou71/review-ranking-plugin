<?php

class Beer_Reviews_Service_Import
{
    private function __construct()
    {
    }

    public static function factory()
    {
        static $instance = false;

        if (!$instance) {
            $instance = new self();
        }

        return $instance;
    }

    public function import_beer_feed() // Call the API to get all data
    {
        /*
		$beer_id = Beer_Review_Config::beer_id;
        $client_id = Beer_Review_Config::client_id;
        $client_secret = Beer_Review_Config::client_secret;
        $api = sprintf(Beer_Review_Config::Beer_Feed, $beer_id, $client_id, $client_secret);

        $data = wp_remote_get($api);
        if (is_wp_error($data)) {
            wp_die('There is no beer data. Please check the internet connection or Bear API only allows 100 requests per hour.','No Data');
        }

        $data = wp_remote_retrieve_body($data);
		$data = json_decode($data);
		*/
		/**/
        $jsonfile = plugin_dir_path(dirname(__FILE__)) . '110569.json';
        $data = json_decode(file_get_contents($jsonfile));		
		/**/
        $data = isset($data->response->beer)?$data->response->beer:0;

        if (empty($data)) {
            wp_die('No beer data found.','No Beer Data');
        }

        $beer = $this->read_beer($data);
        $reviews = $this->read_beer_reviews($data);
        return (object) array(
            'beer' => $beer,
            'reviews' => $reviews,
            'raw_data' => $data,
        );
    }

    private function read_beer($beer) // collect the beer information
    {
        return (object) array(
            'beer_name' => $beer->beer_name,
            'brewery_name' => $beer->brewery->brewery_name,
            'beer_style' => $beer->beer_style,
            'beer_abv' => $beer->beer_abv,
            'beer_ibu' => $beer->beer_ibu,
            'rating_score' => round($beer->rating_score,2),
            'beer_label' => $beer->beer_label,
            'brewery_label' => $beer->brewery->brewery_label,
        );
    }

    private function read_beer_reviews($data) // collect the user reviews
    {
        $reviews = $data->checkins->items;
        return array_map(function($each){
                return (object) array(
                'user_name' => $each->user->user_name,
                'created_at' => $this->local_time( $each->created_at ), // UTC to WordPress Local date and time
                'rating_score' => $this->score_empty($each->rating_score),
                );
            
        }, $reviews);
    }
    
    private function local_time($dateTime) // UTC to local date/time based on WordPress time zone setting.
    {
        $dt = get_date_from_gmt(($dateTime), 'Y-m-d H:i:s'); 
        return date_i18n(get_option('date_format') . ', ' . get_option('time_format'), strtotime($dt));    
    }
    
    private function score_empty($rating_score) // If there is no review rating from users, it may be N/A, too.
    {
        if(esc_html($rating_score)==0){
        $rating_score = 'N/A or 0'; 
        }else{
        $rating_score =  $rating_score.' / 5';                             
        }
        return  $rating_score;
    }

}
Beer_Reviews_Service_Import::factory(); // Use the Singleton ways for the objects
