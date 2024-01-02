<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index(Request $request)
    {
        try {
            $perPage = $request->input("pageSize", 10);
            $page = $request->input("numberOfPage", 1);
            $offset = ($page - 1) * $perPage;
            $totalQuestions = Question::count();
            $totalPages = ceil($totalQuestions / $perPage);
            $sort = $request->input('sort', 'trending');
            $questions = Question::with('author', 'tags')
                ->withCount('answers as answercount', 'likes as likecount')
                ->when($sort, function ($query) use ($sort) {
                    if ($sort == 'newest') {
                        $query->orderBy('created_at','desc');
                    }
                    else {
                        //Trending
                        $query->orderBy('viewcount','desc');
                    }
                })
                ->limit($perPage)
                ->offset($offset)
                ->get();

            return response()->json([
                'status' => 'success',
                'numberOfPage' => (int)$page,
                'pageSize' => (int)$perPage,
                'totalPages' => $totalPages,
                'sort' => $sort,
                'questions' => $questions,
            ], 200);

        } catch (Exception $e)
        {
            return response()->json([
                'message' => $e->getMessage(),
                'success' => false,
            ], 500);
        }
    }

    public function search(Request $request)
    {
        $regExp = [
            '/[aáảàạãăắẳằặẵâấẩầậẫ]/iu' => '[aáảàạãăắẳằặẵâấẩầậẫ]',
            '/[eéẻèẹẽêếểềệễ]/iu' => '[eéẻèẹẽêếểềệễ]',
            '/[iíỉìịĩ]/iu' => '[iíỉìịĩ]',
            '/[uúủùụũưứửừựữ]/iu' => '[uúủùụũưứửừựữ]',
            '/[oóỏòọõôốổồộỗơớởờợỡ]/iu' => '[oóỏòọõôốổồộỗơớởờợỡ]',
            '/[yýỷỳỵỹ]/iu' => '[yýỷỳỵỹ]',
            '/[dđ]/iu' => '[dđ]',
        ];

        try {
            $result = $request->keyword;
            foreach ($regExp as $key => $value) {
                $result = preg_replace($key, $value, $result);
            }

            $perPage = $request->input("pageSize", 10);

            $tags = $request->input('tags', []);

            $questions = Question::with('author', 'tags')
                ->withCount('answers', 'likes')
                ->when($request->sort, function ($query) use ($request) {
                    if ($request->sort == 'latest') {
                        $query->orderBy('created_at','desc');
                    } else {
                        $query->orderBy('created_at','desc');
                    }
                })
                ->when($request->keyword, function ($query) use ($result) {
                    $query->where('title', 'REGEXP', $result);
                })
                ->when($request->status, function ($query) use ($request) {
                    switch ($request->status)
                    {                        
                        case '1':
                            $query->whereNull('accepted_answer_id');
                            break;

                        case '2':
                            $query->whereNotNull('accepted_answer_id');
                            break;
                        default:
                    }
                })
                ->when(count($tags), function ($query) use ($tags) {
                    foreach ($tags as $tag)
                    {
                        $query->whereHas('tags', function ($q) use ($tag) {
                            $q->where('tags.tag_name', $tag);
                        });
                    }
                })
                ->paginate($perPage);

            return response()->json([
                'pagination' => $questions,
                'message' => 'Searched successfully',
                'tags' => $tags,
                'success' => true,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'success' => false,
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $question = Question::with('author', 'answers', 'tags')
                ->withCount('likes')
                ->findOrFail($id);

            foreach ($question->answers as $answer) {
                $answer->user;
                $answer->likes_count = $answer->likes()->count();
                unset($answer->likes);
            }

            return response()->json([
                'data' => $question,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'success' => false,
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'success' => false,
            ], 500);
        }
    }
}
