<?php

namespace TestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class RedditController extends Controller
{
    /**
     * Home Page Render
     * @return Response
     */
    public function indexAction()
    {
        return $this->render("TestBundle:Reddit:index.html.twig");
    }

    /**
     * Api Request Process and Render
     * @param Request $request
     * @return Response
     */
    public function apiAction(Request $request){
        if(isset($request)){
            $fronName = $request->attributes->get('_route_params');
            $json = file_get_contents("https://www.reddit.com/".$fronName['frontName'].".json");
            $result = array();
            $data = json_decode($json);
            foreach($data->data->children as $arr){

                $value['title'] = $arr->data->title;
                $value['thumbnail'] = $arr->data->thumbnail;
                $value['permalink'] = $arr->data->permalink;
                array_push($result,$value);
            }

            return new Response(json_encode($result));
        }

    }
}
