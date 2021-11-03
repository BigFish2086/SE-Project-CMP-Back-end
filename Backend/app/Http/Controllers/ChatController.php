<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChatController extends Controller
{
/**
 * @OA\Get(
 *  path="/chat/{chat_participant}",
 *  operationId="getAllMessages",
 *  tags={"Chatting"},
 *  security={ {"bearer": {} }},
 *  description="retrieve all messages sent between the current user blog and the other chat_participant",
 *  @OA\Parameter(
 *    in="path",
 *    name="chat_participant",
 *    description="the blog_id/blog_name to chat with.",
 *    required=true,
 *    example="123456789",
 *    @OA\Schema(
 *       type="int",
 *    )
 *  ),
 *  @OA\Response(
 *    response=200,
 *    description="Successful Retrieval",
 *    @OA\JsonContent(
 *     @OA\Property(property="meta", type="object", example={"status": "200", "msg":"ok"}),
 *      @OA\Property(property="response", type="object",
 *        @OA\Property(property="chat_messages", type="array",
 *          @OA\Items(
 *           @OA\Property(property="0", type="array",
 *            @OA\Items(
 *             @OA\Property(property="from", type="string", example="blog_name"),
 *             @OA\Property(property="type", type="string", example="text"),
 *             @OA\Property(property="text", type="string", example="hello world!"),
 *            ),
 *           ),
 *           @OA\Property(property="1", type="array",
 *            @OA\Items(
 *             @OA\Property(property="from", type="string", example="blog_name"),
 *             @OA\Property(property="type", type="string", example="photo"),
 *             @OA\Property(property="photo", type="url", example="/storage/photo_example.jpg"),
 *            ),
 *           ),
 *           @OA\Property(property="2", type="array",
 *            @OA\Items(
 *             @OA\Property(property="from", type="string", example="blog_name"),
 *             @OA\Property(property="type", type="string", example="text"),
 *             @OA\Property(property="text", type="string", example="hello world!"),
 *             @OA\Property(property="gif", type="url", example="/storage/gif_example.gif"),
 *            ),
 *           ),
 *          ),
 *         ),
 *        ),
 *       ),
 *      ),
 *  @OA\Response(
 *    response=401,
 *    description="Unauthorized",
 *    @OA\JsonContent(
 *     @OA\Property(property="meta", type="object", example={"status": "401", "msg":"unauthorized"}),
 *     ),
 *  ),
 *  @OA\Response(
 *   response=404,
 *   description="Not Found",
 *   @OA\JsonContent(
 *      @OA\Property(property="meta", type="object", example={"status": "404", "msg":"Not Found"}),
 *   ),
 *  ),
 * )
 * )
 */

/**
 * @OA\Post(
 *  path="/chat/{chat_participant}",
 *  operationId="sendMessage",
 *  tags={"Chatting"},
 *  security={ {"bearer": {} }},
 *  description="send messages to the other chat_participant.",
 *  @OA\Parameter(
 *    in="path",
 *    name="chat_participant",
 *    description="the blog_id/blog_name to chat with.",
 *    required=true,
 *    example="123456789",
 *    @OA\Schema(
 *       type="int",
 *    )
 *  ),
 *  @OA\RequestBody(
 *   description="send one of the following types {text | gif | photo | text + gif | text + photo}
 *   text: send a text message or empty
 *   gif: send a gif message or empty
 *   photo: send a photo message or empty",
 *   @OA\JsonContent(
 *    @OA\Property(property="text", type="string", example="hello, how are you?"),
 *    @OA\Property(property="gif", type="url", example="/storage/gif_example.gif"),
 *    @OA\Property(property="photo", type="url", example="/storage/photo_example.gif"),
 *   ),
 *  ),
 *  @OA\Response(
 *   response=200,
 *   description="Successful Sent",
 *   @OA\JsonContent(
 *    @OA\Property(property="meta", type="object", example={"status": "200", "msg":"ok"}),
 *     @OA\Property(property="response", type="object",
 *      @OA\Property(property="last_message", type="array",
 *       @OA\Items(
 *        @OA\Property(property="from", type="string", example="blog_name"),
 *        @OA\Property(property="type", type="string", example="text"),
 *        @OA\Property(property="text", type="string", example="hello world!"),
 *        @OA\Property(property="gif", type="url", example="/storage/gif_example.gif"),
 *       ),
 *      ),
 *     ),
 *    ),
 *  ),
 *  @OA\Response(
 *    response=401,
 *    description="Unauthorized",
 *    @OA\JsonContent(
 *     @OA\Property(property="meta", type="object", example={"status": "401", "msg":"unauthorized"}),
 *    ),
 *  ),
 *  @OA\Response(
 *   response=404,
 *   description="Not Found",
 *   @OA\JsonContent(
 *      @OA\Property(property="meta", type="object", example={"status": "404", "msg":"Not Found"}),
 *   ),
 *  ),
 * )
 */

/**
 * @OA\Delete(
 *  path="/chat/{chat_participant}/clear",
 *  operationId="clearChatRoom",
 *  tags={"Chatting"},
 *  security={ {"bearer": {} }},
 *  description="delete all messages in the chat room between this blog and the other chat_participant",
 *  @OA\Parameter(
 *    in="path",
 *    name="chat_participant",
 *    description="the blog_id/blog_name to chat with.",
 *    required=true,
 *    example="123456789",
 *    @OA\Schema(
 *       type="int",
 *    )
 *  ),
 *  @OA\Response(
 *   response=200,
 *   description="Successful Operation",
 *   @OA\JsonContent(
 *    @OA\Property(property="meta", type="object", example={"status": "200", "msg":"ok"}),
 *   ),
 *  ),
 *  @OA\Response(
 *    response=401,
 *    description="Unauthorized",
 *    @OA\JsonContent(
 *     @OA\Property(property="meta", type="object", example={"status": "401", "msg":"unauthorized"}),
 *    ),
 *  ),
 *  @OA\Response(
 *   response=404,
 *   description="Not Found",
 *   @OA\JsonContent(
 *      @OA\Property(property="meta", type="object", example={"status": "404", "msg":"Not Found"}),
 *   ),
 *  ),
 * )
 */


}
