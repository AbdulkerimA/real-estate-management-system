<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\Property;
use App\Models\PropertyDetail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\Calculation\Financial\Securities\Price;
use PhpOffice\PhpSpreadsheet\Chart\Properties;

use function Pest\Laravel\get;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $this->authorize('update', );

        $agent_id = $request->get('id');
        if($agent_id == null){
            $properties = Property::with('details')->where('status','approved')->paginate(10);
        }
        else{
            $properties = Property::with('details')->where('agent_id',$agent_id)->paginate(10);
        }

        $totalDisplayedProperties =  $properties->perPage() * $properties->currentPage();
        $firstElement = $properties->currentPage() > 1 ? $properties->perPage() + 1 : 1;

        // dd($properties->total());
        return view('properties.index',[
            'properties'=>$properties,
            'displayedPropertisInfo' => $firstElement . "-" . $totalDisplayedProperties,
            "sortedBy" => "newest",
        ]);
    }

    /**
     * search general types of propertyies
     */

    private function searchByLocation($location, $properties)
    {
        $properties = $properties
                    ->where('location',$location);
        return $properties;
    }

    // filter by type
    private function searchByType($type, $properties)
    {
        $properties = $properties->where('type',$type);
        return $properties;
    }

    // filter by price range
    private function searchByPrice($price, $properties)
    {   
        if($price != '5000000+'){
            $priceRange = explode('-',$price);
            $properties = $properties->whereBetween('price', [$priceRange[0], $priceRange[1]]);
        }
        else{      
            $properties = Property::with('details')->where('price','>','5000000');
        }

        // dd($properties->get());
        return $properties;
    }
    private function searchByBedRooms($bedRooms, Builder $properties)
    {
        if($bedRooms == "5+"){
            $propertyIds = PropertyDetail::where('bed_rooms', '>=', 5)->pluck('property_id');
        }
        else{
            $propertyIds = PropertyDetail::where('bed_rooms', $bedRooms)->pluck('property_id');
        }

        return $properties->whereIn('id',$propertyIds);
    }

    private function validateSearchRequests(Request $request){

        // dd($request->post());
        $validated = $request->validate([
            'location' => "nullable|min:3",
            'type' => "nullable",
            'price_range' => "nullable",
            'bed_rooms' => "nullable",
        ]); 

        return $validated;
    }

    public function search(Request $request) {

        // dd($request->post());
        $propertiesBase = Property::with('details')->where('status','approved');
        $validated = $this->validateSearchRequests($request);
        $SearchFlag = true;

        foreach($validated as $key=>$value){
            if($value != null){
                $SearchFlag = true;
                break;
            }    
            else
                $SearchFlag = false;
        }

        if($SearchFlag)
        {
            foreach($validated as $key=>$value)
            {
                if($key == 'location' && $value != null){
                    $properties = $this->searchByLocation($value,$propertiesBase);
                }
                else if($key == 'type' && $value != null){
                    $properties = $this->searchByType($value,$propertiesBase);
                }
                else if($key == 'price_range' && $value != null){
                    $properties = $this->searchByPrice($value,$propertiesBase);
                }
                else if($key == 'bed_rooms' && $value != null){
                    $properties = $this->searchByBedRooms($value,$propertiesBase);
                }
            }
        }
        else
            $properties = $propertiesBase;
        
        
        // dd($properties->paginate(10));
        

        $properties = $properties->paginate(10);
        $totalDisplayedProperties =  $properties->perPage() * $properties->currentPage();
        $firstElement = $properties->currentPage() > 1 ? $properties->perPage() + 1 : 1;

        // dd($properties);

        return view('properties.index',[
            'properties' => $properties,
            'displayedPropertisInfo' => $firstElement . "-" . $totalDisplayedProperties,
            'sortedBy' => "newest",
        ]);
    }

    public function sortProperties(Request $request){
        // dd($request->post());

        $validated = $request->validate([
            'sortBy' => 'required | in:latest,priceHigh,priceLow,popular',
        ]);

        $sortedBy = "newest";

        switch ($validated['sortBy']) {
            case 'latest':
                $properties = Property::latest()->where('status','approved')->paginate(10);
                break;
            case 'priceHigh':
                $properties = Property::orderBy('price','asc')->where('status','approved')->paginate(10);
                $sortedBy="Low to High";
                break;
            case 'priceLow':
                $properties = Property::orderByDesc('price')->where('status','approved')->paginate(10);
                $sortedBy=" High to Low";
                break;
            default:
                $properties = Property::latest()->where('status','approved')->paginate(10);
                break;
        }

        $totalDisplayedProperties =  $properties->perPage() * $properties->currentPage();
        $firstElement = $properties->currentPage() > 1 ? $properties->perPage() + 1 : 1;

        // dd($properties);

        return view('properties.index',[
            'properties' => $properties,
            'displayedPropertisInfo' => $firstElement . "-" . $totalDisplayedProperties,
            'sortedBy' => $sortedBy,
        ]);
    }
    /**
     * display propertis in the admin page
     */
    public function adminPropertyIndex(Property $properties){


        $paginationNumber = request()->get('per_page') ?? 5;

        $allProperties = $properties->all();
        
        
        $pendingProperties = $allProperties->filter(function ($property){
            return $property->status == 'pending'; 
        });
        
        $approvedProperties = $allProperties->filter(function ($property){
            return $property->status == 'approved'; 
        });

        $soldProperties = $allProperties->filter(function ($property){
            return $property->status == 'sold'; 
        });
        

        
        // dd(json_decode($allProperties->first()->media->file_path));
        
        return view('admin.properties.index',[
            'totalProperties' => $allProperties != null ? count($allProperties) : 0,
            'pendingProperties' => $pendingProperties != null ? count($pendingProperties) : 0,
            'approvedProperties' => $approvedProperties != null ? count($approvedProperties) : 0,
            'soldProperties' => $soldProperties != null ? count($soldProperties) : 0,
            'properties' => $properties->paginate($paginationNumber),
        ]);
    }

    public function getPropertyInfo ($id){
        $property = Property::with(['user.agentProfile.media', 'media'])->findOrFail($id);

        return response()->json([
            'id' => $property->id,
            'title' => $property->title,
            'description' => $property->description,
            'location' => $property->location,
            'price' => $property->price,
            'type' => $property->type,
            'status' => $property->status,
            'agent' => [
                'name' => $property->user->name,
                'image' => asset('storage/'.$property->user->agentProfile->media->file_path)
            ],
            'images' => json_decode($property->media->file_path)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Property $property)
    {
        $relatedProperties = Property::where('type',value:$property->type);
        $agent = Agent::where('user_id',$property->agent_id)->first();
        // $scheduled = $property->appointments->first()->buyer->is(Auth::user()); // costs us one more query
        $appointment = $property->appointments;
        $scheduled = optional($appointment->first())->buyer_id == Auth::user()->id;
        // dd();

        return view('properties.show',[ 
            'property'=>$property, 
            'properties' => $relatedProperties,
            'agent'=>$agent,
            'scheduled'=>$scheduled,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Property $property)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Property $property)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Property $property,Request $r)
    {
        // dd($r->all(),$property);
        $property->delete();
        return redirect('/dashboard/properties');
    }
}
