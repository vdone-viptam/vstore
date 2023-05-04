<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\UserReferral;
use App\Models\Vshop;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AffUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:split';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            DB::beginTransaction();
            $user_re = UserReferral::where('is_split','!=',1)
                ->where('created_at','<=',Carbon::now()->addDay(-5))
                ->get();
            if (count($user_re)>0){

                foreach ($user_re as $val){

                    $user = User::where('id',$val->user_id)->first();
                    $vshop = Vshop::where('pdone_id',$val->vshop_id)->orWhere('vshop_id',$val->vshop_id)->first();
                    if ($user && $vshop){
                        $type =0;
                        $money=0;
                        if($user->role_id == 4){
                            $type=1;
                            $money= 600000;

                        }elseif ($user->role_id == 3){
                            $type=3;
                            $money= 6000000;
                        }
                        elseif ($user->role_id ==2 ){
                            $type = 2;
                            $money= 6000000;
                        }
//                     chuẩn bị string đẻ hmac
//                    accountCode=abcxyz&accountId=1&pDoneId=VNO398917577&userId=247&value=6000000&type=1
                        $string_hmac = 'representativePDoneId='.$user->id_vdone . '&accountCode='. $user->account_code
                            . '&accountId='. $user->id .'&pDoneId='.$vshop->vshop_id .'&userId='.$vshop->pdone_id . '&value='.$money.'&type='.$type;


//                    representativePDoneId=VN1234598760&accountCode=gf3d34r34hg6&accountId=111&pDoneId=VN2678123123&userId=63&value=600000&type=1
                        $sig = hash_hmac('sha256',$string_hmac,config('domain.key_split'));
                        $respon =  Http::post(config('domain.domain_vdone').'vnd-wallet/v-shop/register-commission',
                            [
//
                                'representativePDoneId'=>$user->id_vdone,
                                'accountCode'=>$user->account_code,
                                'accountId'=>$user->id,
                                'pDoneId'=>$vshop->vshop_id,
                                'userId'=>(int)$vshop->pdone_id,
                                'value'=>$money,
                                'type'=>$type,
                                'signature'=>$sig

                            ]
                        );
                        $val->is_split=1;;
                        $val->save();
                    }
                }
            }
            DB::commit();

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return $e->getMessage();

        }
    }
}
