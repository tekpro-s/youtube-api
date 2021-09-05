<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\YoutubeController;

//GoogleAPIライブラリを読み込む
require_once(__DIR__ . '/../vendor/autoload.php');
//先ほど取得したAPIキーを定数にセットする
const API_KEY = "AIzaSyDdjOO7OqxxPp8IPJThW8zojhQGM8PyonI";

//認証を行う
function getClient()
{
    $client = new Google_Client();
    $client->setApplicationName("youtube-api-test");
    $client->setDeveloperKey(API_KEY);
    return $client;
}

//動画を取得する.
function searchVideos()
{
    $youtube = new Google_Service_YouTube(getClient());
    //ここに好きなYouTubeのチャンネルIDを入れる
    $params['channelId'] = 'UCbajpFNYPYj7Kg0S3gaBzUA';
    $params['type'] = 'video';
    $params['maxResults'] = 10;
    $params['order'] = 'date';
    try {
        $searchResponse = $youtube->search->listSearch('snippet', $params);
    } catch (Google_Service_Exception $e) {
        echo htmlspecialchars($e->getMessage());
        exit;
    } catch (Google_Exception $e) {
        echo htmlspecialchars($e->getMessage());
        exit;
    }
    foreach ($searchResponse['items'] as $search_result) {
        $videos[] = $search_result;
    }
    return $videos;
}

$videos = searchVideos();

//取得した動画のサムネを表示してみる
foreach ($videos as $video) {
    echo '<img src="' . $video['snippet']['thumbnails']['high']['url'] . '" />';
}

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('youtube/channels/{id}/titles', [YoutubeController::class, 'getListByChannelId']);

// Route::get('/', function () {
//     return view('welcome');
// });
