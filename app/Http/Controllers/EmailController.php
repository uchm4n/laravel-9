<?php

namespace App\Http\Controllers;

use App\Exceptions\EmailNotSend;
use App\Jobs\SendEmailJob;
use App\Models\User;
use App\Utilities\Contracts\ElasticsearchHelperInterface;
use App\Utilities\Contracts\RedisHelperInterface;
use App\Utilities\Services\ElasticHelper;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    public function send(User $user, Request $request)
    {

        // TODO:: validation can be added/injected beforehand. for now it's implemented this way for testing
        $body = $request->get('body');
        $subject = $request->get('subject');
        $fromEmail = $request->get('email');


        try {
            /** @var ElasticsearchHelperInterface $elasticsearchHelper */
            $elasticsearchHelper = app()->make(ElasticsearchHelperInterface::class);
            $elasticsearchHelper->storeEmail($body,$subject,$fromEmail);

            // high priority emails will goe here
            SendEmailJob::dispatch($request->all(), $user)->onQueue('high'); // best would be $request->validated()
            // others here . asynchronously
            SendEmailJob::dispatch($request->all(), $user)->onQueue('default');
        } catch (EmailNotSend $e){
            return response()->json(['error' => $e->getMessage()],500);
        }

        return response()->json(['message' => 'email sent successfully !', 'status' => 'success']);

        // TODO: Create implementation for storeRecentMessage and uncomment the following line
        ///** @var RedisHelperInterface $redisHelper */
        //$redisHelper = app()->make(RedisHelperInterface::class);
        //// $redisHelper->storeRecentMessage(...);
    }

    public function list(ElasticsearchHelperInterface $elasticHelper)
    {
        return response()->json(data_get($elasticHelper->listAllEmails(),'hits.hits.*._source'));
    }
}
