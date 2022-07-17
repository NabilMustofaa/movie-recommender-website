<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Xendit\Xendit;

class OrderController extends Controller
{
    function createCustomer(){
        $url = "https://api.xendit.co/customers";
        $apiKey = env('XENDIT_API_KEY');
        $headers = [];
        $headers[] = "Content-Type: application/json";
        $data = [
          "reference_id" => "demo_14758019626072111",
          "type" => "INDIVIDUAL",
          "given_names" => "John",
          "surname" => "Doe",
          "email" => "customer@website.com",
          "mobile_number" => "+628121234567890"
        ];
      
        $curl = curl_init();
      
        $payload = json_encode($data);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_USERPWD, $apiKey.":");
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      
        $result = curl_exec($curl);
        echo $result;
    }
    function getCustomer(){
        $url = "https://api.xendit.co/customers";
        $apiKey = "xnd_development_O46JfOtygef9kMNsK+ZPGT+ZZ9b3ooF4w3Dn+R1k+2fT/7GlCAN3jg==:";
        $headers = [];
        $headers[] = "Content-Type: application/json";

        $queryString = "?reference_id=demo_14758019626072111";

        $curl = curl_init();

        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_USERPWD, $apiKey.":");
        curl_setopt($curl, CURLOPT_URL, $url.$queryString);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($curl);
        echo $result;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Xendit::setApiKey('xnd_development_P4qDfOss0OCpl8RtKrROHjaQYNCk9dN5lSfk+R1l9Wbe+rSiCwZ3jw==');

        $params = [ 
            'external_id' => 'demo_1475801962607',
            'payer_email' => auth()->user()->email,
            'description' => 'Movie Rent'.$request->movie_title,
            'amount' => $request->price,
        ];

        $createInvoice = \Xendit\Invoice::create($params);
        dump($createInvoice);

        return redirect($createInvoice["invoice_url"]);
        }
        

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
