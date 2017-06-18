<?php

namespace App\Http\Controllers;

use App\Message;
use App\Thread;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    private $thread;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Thread $thread, Message $message)
    {
        $this->message = $message;
        $this->thread = $thread;
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
        $fields = $request->all();
        $isFirstMessage = !isset($fields['In-Reply-To']);

        // Create or get thread
        if ($isFirstMessage) {
            $thread = $this->thread->create([
                'reference' => $fields['Message-Id'],
                'subject' => $fields['subject']
            ]);
        } else {
            $reference = explode(' ', $fields['References']);
            $thread = $this->thread->where('reference', reset($reference))->first();
        }

        // Add message
        $thread->messages()->create([
            'thread_reference' => $isFirstMessage? $fields['Message-Id'] : $fields['References'],
            'in_reply_to' => $fields['In-Reply-To'] ?? '',
            'from' => $fields['sender'],
            'to' => $fields['recipient'],
            'subject' => $fields['subject'],
            'body_html' => $fields['body-html'],
            'date' => $fields['Date']
        ]);

        // Respond
        return ['success' => true];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        //
    }
}
